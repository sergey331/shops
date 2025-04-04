<?php

namespace Kernel\Route;

use Kernel\Container\Container;

class RouteAction
{
    protected string $pattern = '/\{([^}]+)\}/';
    public function __construct(
        protected Container $container
    ) {
    }

    public function getAction($routers)
    {
        $url = $this->container->get('request')->getUri();
        $method = $this->container->get('request')->getMethod();
        $p = explode('/', trim($url,'/'));
        $id = end($p);
        $newRouters = [];
        foreach ($routers as $router) {
            foreach ($router->getRoutes()[$method] as $path => $route) {
                preg_match($this->pattern, $path, $matches);
                if (!empty($matches)) {
                    $path = preg_replace($this->pattern, $id, $path);
                    if (is_numeric($id)) {
                        $param = [$matches[1] => $id];
                        $route['params'] = array_merge($route['params'], $param);
                    }
                }
                $newRouters[$path] = $route;
            }
        }
        return $newRouters[$url] ?? null;
    }
}