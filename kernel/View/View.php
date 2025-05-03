<?php

namespace Kernel\View;

use Kernel\Session\Session;

class View implements ViewInterface
{
    private Session $session;
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    public function load($path, $data = [], $layout = 'app'): void
    {
        $path = $this->getPath($path);

        $data = $this->getData($data);
        extract($data);
        if (file_exists($path)) {
            ob_start();
            require $path;
            $this->layout($layout);
        }
    }

    private function layout($layout): void
    {
        $content = ob_get_clean();
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

    private function getData($data) 
    {
        return array_merge($data,['session' => $this->session]);

    }


}