<?php

namespace Kernel\View;

use Kernel\Container\Container;
use Kernel\View\interface\ViewInterface;

class View implements ViewInterface
{
    public function __construct(protected Container $container)
    {
    }

    public function load($path, $data = [], $layout = 'app'): void
    {
        $template = new Template($this->container);
        $template->load($path, $data, $layout);
    }

    public function getHtml($path, $data): false|string
    {
        $template = new Template($this->container);
        return $template->getHtml($path, $data);
    }
}
