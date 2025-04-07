<?php

namespace Kernel\Route;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use Kernel\Container\Container;

class Routers
{
    protected array $routes = [];
    protected string $method;

    protected Container $container;

    #[NoReturn] public function __construct(Container $container)
    {
        $this->getRoutes();
        $this->container = $container;
    }

    /**
     * @throws Exception
     */
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
        $route = $this->container->get('routeAction')->getAction($this->routes);

        if (!empty($route['group']['middleware'])) {
            $middlewares = (array) $route['group']['middleware'];
            foreach ($middlewares as $middlewareClass) {
                $resolver = new RouteMiddleware();
                $middleware = $resolver->getMiddleware($middlewareClass);

                if (class_exists($middleware)) {
                    if (!(new $middleware())->handle()) {
                        echo "You not have permission for this action";
                        exit(500);
                    }
                }
            }
        }
        if ($route) {
            $action = $route['action'];
            $params = $route['params'] ?? [];

            if (is_array($action)) {
                [$controller, $method] = $action;
                $controller = new $controller();

                call_user_func([$controller, 'setContainer'], $this->container);
                call_user_func([$controller, $method],...$params);
            } else if (is_callable($action)) {
                call_user_func($action);
            } else {
                echo "404 | not found";
            }
        } else {
            echo "404 | not found";
        }
    }
}