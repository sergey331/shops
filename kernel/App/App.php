<?php

namespace Kernel\App;

use Kernel\Container\Container;
use Exception;

class App
{
    protected Container $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function setRouter($file): void
    {
        require_once $file;
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $routes = $this->container->get('router');
        $routes->dispatch();
    }
}
