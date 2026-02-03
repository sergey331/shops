<?php

namespace Kernel\Route;

use Kernel\Container\Container;
use Kernel\Route\interface\RouteControllerInterface;

class RouteController implements RouteControllerInterface
{
    protected array|\Closure|null $actions;
    protected array $params;
    protected Container $container;

    public function __construct(
        array|\Closure|null $actions,
        array $params,
        Container $container
    ) {
        $this->actions   = $actions;
        $this->params    = $params;
        $this->container = $container;
    }

    public function resolve(): void
    {
        /** Controller@method */
        if (is_array($this->actions)) {
            [$controllerClass, $method] = $this->actions;

            if (!class_exists($controllerClass)) {
                $this->abort404();
                return;
            }

            $controller = new $controllerClass();

            if (!method_exists($controller, $method)) {
                $this->abort404();
                return;
            }

            if (method_exists($controller, 'setContainer')) {
                $controller->setContainer($this->container);
            }

            $params = $this->filterParams($this->params);

            $controller->$method(...$params);
            return;
        }

        /** Closure route */
        if ($this->actions instanceof \Closure) {
            ($this->actions)(...$this->filterParams($this->params));
            return;
        }

        $this->abort404();
    }

    protected function filterParams(array $params): array
    {
        unset($params['middleware']);
        return array_values($params);
    }

    protected function abort404(): void
    {
        $this->container->get('views')->load('404.404');
    }
}
