<?php

namespace Kernel\View;

use Kernel\Container\Container;

class View implements ViewInterface
{
    public function __construct(protected Container $container)
    {
    }

    public function load($path, $data = [], $layout = 'app'): void
    {
        $viewPath = $this->resolvePath($path);
        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View not found: {$viewPath}");
        }

        $data = $this->prepareData($data);
        extract($data);

        ob_start();
        $content = file_get_contents($viewPath);
        eval('?>' . $this->compileTemplate($content));
        $content = ob_get_clean();

        $this->renderLayout($layout, $data, $content);
    }

    private function renderLayout(string $layout, array $data, string $content): void
    {
        $layoutPath = $this->resolveLayoutPath($layout);
        if (!file_exists($layoutPath)) {
            throw new \RuntimeException("Layout not found: {$layoutPath}");
        }

        $data['content'] = $content; // make $content available in layout
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
        return array_merge($data, [
            'session' => $this->container->get('session'),
            'auth'    => $this->container->get('auth'),
        ]);
    }

    private function compileTemplate(string $template): string
    {
        $replacements = [
            '/@auth/'         => '<?php if ($auth->user()): ?>',
            '/@else/'         => '<?php else: ?>',
            '/@endif/'        => '<?php endif; ?>',
            '/@endauth/'      => '<?php endif; ?>',
            '/@endforeach/'   => '<?php endforeach; ?>',
            '/@if\s*\((.*?)\)/'      => '<?php if ($1): ?>',
            '/@elseif\s*\((.*?)\)/'  => '<?php elseif ($1): ?>',
            '/@foreach\s*\((.*?)\)/' => '<?php foreach ($1): ?>',
            '/{{\s*(.*?)\s*}}/'      => '<?php echo htmlspecialchars($1, ENT_QUOTES, "UTF-8"); ?>',
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

    private function renderInclude(string $view): string
    {
        $auth = $this->container->get('auth');
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
