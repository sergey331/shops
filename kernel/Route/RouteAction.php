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


    public function getAction(array $routers)
    {
        $request = $this->container->get('request');
        $url = $request->getUri();
        $method = $request->getMethod();
        $segments = explode('/', trim($url, '/'));
        $id = end($segments);
        $flatRouters = $this->flattenRoutes($routers);
        $newRouters = [];
        foreach ($flatRouters as $router) {
            if ($router['method'] !== $method) {
                continue;
            }
            preg_match($this->pattern, $router['uri'], $matches);
            if (!empty($matches)) {
                if (is_numeric($id)) {
                    $param = [$matches[1] => $id];
                    $router['params'] = array_merge($router['params'], $param);
                }
            }
            $newRouters[$router['uri']] = $router;
        }
        return $newRouters[$url] ?? null;

        return null;
    }
    protected function flattenRoutes(array $routers): array
    {
        $flat = [];

        foreach ($routers as $router) {
            if (is_array($router) && isset($router[0]) && is_array($router[0])) {
                foreach ($router as $route) {
                    $flat[] = $route;
                }
            } else {
                $flat[] = $router;
            }
        }

        return $flat;
    }
}