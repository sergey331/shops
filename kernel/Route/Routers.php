<?php

namespace Kernel\Route;

use Exception;
use Kernel\Container\Container;

class Routers
{
    protected array $routes = [];
    protected string $method;

    protected Container $container;
    public function __construct(Container $container)
    {
        $this->getRoutes();
        $this->container = $container;
    }
    public function dispatch(): void
    {
        $this->match();
    }

    private function getRoutes(): void
    {
        $this->routes = require APP_PATH . '/config/router.php';
    }

    /**
     * @throws Exception
     */
    private function match(): void
    {
        $url = $this->container->get('request')->getUri();
        $method = $this->container->get('request')->getMethod();
        $action = null;
         foreach($this->routes as $route)  {
            $action = $route->getRoutes()[$method][$url]['action'] ?? null;
        }
        if (is_array($action)) {
            [$controller, $method] = $action;
            $controller = new $controller();
            call_user_func([$controller, 'setContainer'], $this->container);
            call_user_func([$controller, $method]);
        } else if (is_callable($action)) {
            call_user_func($action);
        } else {
            echo "404 | not found";
        }
    }
}