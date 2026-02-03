<?php

namespace Kernel\Route;

use Kernel\Route\interface\MiddlewareInterface;
use Kernel\Route\interface\RouteMiddlewareInterface;

class RouteMiddleware implements RouteMiddlewareInterface
{
    private array $middlewares = [];
    private array $selectedMiddleware = [];

    public function __construct(array $selectedMiddleware)
    {
        $this->getMiddlewares();
        $this->selectedMiddleware = $selectedMiddleware;
    }

    public function resolve($container): bool
    {
        foreach ($this->selectedMiddleware as $middlewareClass) {
            $middleware = $this->getMiddleware($middlewareClass);
            if (class_exists($middleware)) {
                /* @var MiddlewareInterface $middleware */
                if (!(new $middleware($container))->handle()) {
                   return false;
                }
            }
        }
        return true;
    }

    private function getMiddleware($name)
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