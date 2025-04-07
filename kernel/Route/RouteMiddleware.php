<?php

namespace Kernel\Route;

class RouteMiddleware
{
    private array $middlewares = [];

    public function __construct()
    {
        $this->getMiddlewares();
    }

    public function getMiddleware($name)
    {
        if (isset($this->middlewares[$name])) {
            return $this->middlewares[$name];
        }
        return null;
    }
    private function getMiddlewares(): void
    {
        $kernel = require APP_PATH . '/src/kernel.php';
        $this->middlewares = $kernel['middlewares'];
    }

}