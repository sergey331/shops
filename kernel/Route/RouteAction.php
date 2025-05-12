<?php

namespace Kernel\Route;

use Kernel\Container\Container;
use Kernel\Request\RequestInterface;

class RouteAction implements RouteActionInterface
{
    protected string $pattern = '/\{([^}]+)\}/';
    public function __construct(
        protected Container $container
    ) {
    }


    public function getAction(array $routers)
    {
        /* @var RequestInterface $request */
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
                    $router['uri'] = preg_replace($this->pattern, $id, $router['uri'],);
                    $param = [$matches[1] => $id];
                    $router['params'] = array_merge($router['params'], $param);
                }
            }
            $newRouters[$router['uri']] = $router;
        }
        return $newRouters[$url] ?? null;
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