<?php

namespace Kernel\Route;

use Exception;
use Kernel\Container\Container;
use Kernel\Route\interface\RoutersInterface;

class Routers implements RoutersInterface
{
    protected array $routes = [];
    protected ?RouteConfig $route = null;
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->routes = Route::getRoutes();
    }

    /**
     * @throws Exception
     */
    public function dispatch(): void
    {
        $this->resolveRoute();
        $this->handleRequest();
    }

    private function resolveRoute(): void
    {
        $this->route = $this->container
            ->get('routeAction')
            ->getAction($this->routes);
    }

    /**
     * @throws Exception
     */
    private function handleRequest(): void
    {
        if (!$this->route) {
            $this->abort404();
            return;
        }

        $this->handleMiddleware();

        $controller = new RouteController(
            $this->route->getAction(),
            $this->route->getParams() ?? [],
            $this->container
        );

        $controller->resolve();
    }

    /**
     * @throws Exception
     */
    private function handleMiddleware(): void
    {
        $group = $this->route->getGroup();

        if (empty($group['middleware'])) {
            return;
        }

        $middlewares = (array) $group['middleware'];

        $resolver = new RouteMiddleware($middlewares);

        if (!$resolver->resolve($this->container)) {
            $this->abort403();
        }
    }

    private function abort404(): void
    {
        $this->container->get('views')->load('404.404');
        exit;
    }

    private function abort403(): void
    {
        $this->container->get('views')->load('403.403');
        exit;
    }
}
