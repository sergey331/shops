<?php

namespace Kernel\View;

use Kernel\Container\Container;
use Kernel\Session\Session;

class View implements ViewInterface
{
    public function __construct(protected Container $container)
    {
    }
    public function load($path, $data = [], $layout = 'app'): void
    {
        $path = $this->getPath($path);

        $data = $this->getData($data);
        extract($data);
        if (file_exists($path)) {
            ob_start();
            require $path;
            $this->layout($layout,$data);
        }
    }

    private function layout($layout,$data): void
    {
        $content = ob_get_clean();
        $data = $this->getData();
        extract($data);
        $layoutPath = $this->getHeaderPath($layout);
        $layoutContent = file_get_contents($layoutPath);
        $compiledLayout = $this->extract($layoutContent);
        eval('?>' . $compiledLayout);
    }

    /**
     * @param $layout
     * @return string
     */
    private function getHeaderPath($layout): string
    {
        return APP_PATH . "/src/Views/layouts/" . str_replace('.', '/', $layout) . ".php";
    }

    /**
     * @param $path
     * @return string
     */
    private function getPath($path): string
    {
        return APP_PATH . "/src/Views/" . str_replace('.', '/', $path) . ".php";
    }

    private function getData($data = []) 
    {
        return array_merge($data,[
            'session' => $this->getSession(),
            'auth' => $this->getAuth(),
        ]);

    }

    private function getSession() 
    {
        return $this->container->get('session');   
    }

    private function getAuth() 
    {
        return $this->container->get('auth');   
    }


    private function extract(string $template): string
{

    $pattern = '/@if\s*\(\s*(.*?)\s*\)/';

    $template = preg_replace_callback($pattern, function ($m) {
        return "<?php if ({$m[1]}): ?>";
    }, $template);
    // @elseif (...)
    $template = preg_replace_callback('/@elseif\s*\((.*?)\)/', function ($m) {
        return "<?php elseif ({$m[1]}): ?>";
    }, $template);

    // @else / @endif
    $template = str_replace('@else', '<?php else: ?>', $template);
    $template = str_replace('@endif', '<?php endif; ?>', $template);

    // @foreach
    $template = preg_replace_callback('/@foreach\s*\((.*?)\)/', function ($m) {
        return "<?php foreach ({$m[1]}): ?>";
    }, $template);
    $template = str_replace('@endforeach', '<?php endforeach; ?>', $template);

    // Echo: {{ $var }}
    $template = preg_replace('/{{\s*(.*?)\s*}}/', '<?php echo htmlspecialchars($1); ?>', $template);

    // @include('path')
    $template = preg_replace_callback('/@include\s*\(\s*[\'"](.+?)[\'"]\s*\)/', function ($m) {
        $includedPath = APP_PATH . '/src/Views/' . str_replace('.', '/', $m[1]) . '.php';
        return "<?php include '{$includedPath}'; ?>";
    }, $template);

dd($template);

    return $template;
}

    
}