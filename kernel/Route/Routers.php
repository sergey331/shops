<?php

namespace Kernel\Route;

use Exception;
use Kernel\Container\Container;
use Kernel\Route\interface\MiddlewareInterface;
use Kernel\Route\interface\RoutersInterface;

class Routers implements RoutersInterface
{
    protected array $routes = [];
    protected string $method;

    protected Container $container;

    public function __construct(Container $container)
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
        $this->routes = Route::getRoutes();
    }

    /**
     * @throws Exception
     */
    private function match(): void
    {
        /** @var RouteAction $route */
        $route = $this->container->get('routeAction')->getAction($this->routes);

        if (!empty($route['group']['middleware'])) {
            
            $middlewares = (array) $route['group']['middleware'];
            foreach ($middlewares as $middlewareClass) {
                $resolver = new RouteMiddleware();
                $middleware = $resolver->getMiddleware($middlewareClass);

                if (class_exists($middleware)) {
                    /* @var MiddlewareInterface $middleware */
                    if (!(new $middleware($this->container))->handle()) {
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
                $newParams = [];
                foreach ($params as $key => $value) {
                    if ($key !== 'middleware') {
                        $newParams[] = $value;
                    }
                }
                call_user_func([$controller, 'setContainer'], $this->container);
                call_user_func([$controller, $method],...$newParams);
            } else if (is_callable($action)) {
                call_user_func($action);
            } else {
                $this->container->get('views')->load("404.404");
            }
        } else {
            $this->container->get('views')->load("404.404");
        }
    }
}