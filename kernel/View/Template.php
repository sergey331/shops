<?php 

namespace Kernel\View;

use Kernel\Cart\Cart;
use Kernel\Cart\DbCartStorage;
use Kernel\Cart\SessionCartStorage;
use Kernel\Container\Container;
use Kernel\View\interface\TemplateInterface;

class Template implements TemplateInterface
{
    protected array $data = [];

    public function __construct(protected Container $container)
    {}
    public function load($path, $data = [], $layout = 'app'): void
    {
        $viewPath = $this->resolvePath($path);
        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View not found: {$viewPath}");
        }
        $this->data = $this->prepareData($data);
        extract($this->data);

        ob_start();
        $content = file_get_contents($viewPath);
        eval('?>' . $this->compileTemplate($content));
        $content = ob_get_clean();
        $this->renderLayout($layout,  $content);
    }

    public function getHtml($path, $data = [])
    {
        $viewPath = $this->resolvePath($path);
        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View not found: {$viewPath}");
        }
        $this->data = $this->prepareData($data);
        extract($this->data);

        ob_start();
        $content = file_get_contents($viewPath);
        eval('?>' . $this->compileTemplate($content));
        return ob_get_clean();
    }
    
    private function compileTemplate(string $template): string
    {
        $replacements = [

            // Auth
            '/@auth/'       => '<?php if ($auth->user()): ?>',
            '/@endauth/'    => '<?php endif; ?>',

            // Loops
            '/@foreach\s*\((.*)\)/' => '<?php foreach ($1): ?>',
            '/@endforeach/'           => '<?php endforeach; ?>',
            '/@for\s*\((.*)\)/'     => '<?php for ($1): ?>',
            '/@endfor/'               => '<?php endfor; ?>',

            // Conditional statements with nested parentheses
            '/@if\s*\(((?:[^)(]+|\((?:[^)(]+|\([^)(]*\))*\))*)\)(.*?)@endif/s' => '<?php if ($1): ?>$2<?php endif; ?>',

            '/@elseif\s*\(((?:[^)(]+|\((?:[^)(]+|\([^)(]*\))*\))*)\)/' => '<?php elseif ($1): ?>',
            '/@else/' => '<?php else: ?>',

            // Special helpers
            '/@isset\s*\(((?:[^)(]+|\((?:[^)(]+|\([^)(]*\))*\))*)\)/'   => '<?php if (isset($1)): ?>',
            '/@endisset/'            => '<?php endif; ?>',
            '/@empty\s*\(((?:[^)(]+|\((?:[^)(]+|\([^)(]*\))*\))*)\)/'   => '<?php if (empty($1)): ?>',
            '/@endempty/'            => '<?php endif; ?>',
            '/@noempty\s*\(((?:[^)(]+|\((?:[^)(]+|\([^)(]*\))*\))*)\)/' => '<?php if (!empty($1)): ?>',
            '/@count\s*\(((?:[^)(]+|\((?:[^)(]+|\([^)(]*\))*\))*)\)/'   => '<?php if (is_array($1) && count($1) > 0): ?>',
            '/@endcount/'            => '<?php endif; ?>',
            '/@noisset\s*\(((?:[^)(]+|\((?:[^)(]+|\([^)(]*\))*\))*)\)/' => '<?php if (!isset($1)): ?>',
            '/@inarray\s*\(((?:[^)(]+|\((?:[^)(]+|\([^)(]*\))*\))*)\)/' => '<?php if (in_array($1)): ?>',
            '/@endinarray/'          => '<?php endif; ?>',
            '/@dd\s*\(((?:[^)(]+|\((?:[^)(]+|\([^)(]*\))*\))*)\)/'      => '<?php dd($1); ?>',

            // Echo
            '/{{\s*(.*?)\s*}}/'      => '<?php echo $1; ?>',
            '/{!!\s*(.*?)\s*!!}/s'   => '<?php $1 ?>'
        ];


        $template = preg_replace(array_keys($replacements), array_values($replacements), $template);

        // Handle @include directives
        $template = preg_replace_callback(
            '/@include\s*\(\s*[\'"](.+?)[\'"]\s*\)/',
            fn($matches) => $this->renderInclude($matches[1]),
            $template
        );
        return $template;
    }

    private function renderLayout(string $layout, string $content): void
    {
        $data = $this->prepareData();
        $layoutPath = $this->resolveLayoutPath($layout);
        if (!file_exists($layoutPath)) {
            throw new \RuntimeException("Layout not found: {$layoutPath}");
        }

        $data['content'] = $content;
        extract($data);

        $layoutContent = file_get_contents($layoutPath);
        eval('?>' . $this->compileTemplate($layoutContent));
    }

    private function resolvePath(string $path): string
    {
        return APP_PATH . '/src/Views/' . str_replace('.', '/', $path) . '.php';
    }

    private function resolveLayoutPath(string $layout): string
    {
        return APP_PATH . '/src/Views/layouts/' . str_replace('.', '/', $layout) . '.php';
    }

    private function prepareData(array $data = []): array
    {
        $cartStorage = auth()->check() ? new DbCartStorage() : new SessionCartStorage();
        $cart = new Cart($cartStorage);
        return array_merge($data, [
            'session' => $this->container->get('session'),
            'auth'    => $this->container->get('auth'),
            'cart'    => $cart
        ]);
    }

    private function renderInclude(string $view): string
    {
        extract($this->data);
        $includePath = $this->resolvePath($view);
        if (!file_exists($includePath)) {
            throw new \RuntimeException("Included view not found: {$includePath}");
        }

        $content = file_get_contents($includePath);
        ob_start();
        eval('?>' . $this->compileTemplate($content));
        return ob_get_clean();
    }
}