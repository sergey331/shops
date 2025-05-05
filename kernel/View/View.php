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
        require $this->getHeaderPath($layout);
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
}