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
        $template = new Template($this->container);
        $template->load($path, $data, $layout);
    }
}
