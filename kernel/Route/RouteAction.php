<?php

namespace Kernel\Route;

use Kernel\Container\Container;
use Kernel\Request\interface\RequestInterface;
use Kernel\Route\interface\RouteActionInterface;

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
    $url = strlen($url) > 1 ? rtrim($url, '/') : $url;
    $method = $request->getMethod();

    $flatRouters = $this->flattenRoutes($routers);
    $staticRoutes = [];
    $dynamicRoutes = [];

    foreach ($flatRouters as $router) {
        if ($router['method'] !== $method) {
            continue;
        }

        if (strpos($router['uri'], '{') === false) {
            $staticRoutes[$router['uri']] = $router;
        } else {
            $dynamicRoutes[] = $router;
        }
    }

    if (isset($staticRoutes[$url])) {
        return $staticRoutes[$url];
    }

    $segments = explode('/', trim($url, '/'));
    
    // numeric values from URL
    $ids = array_values(array_filter($segments, 'is_numeric'));

    foreach ($dynamicRoutes as $router) {

        if (!preg_match_all($this->pattern, $router['uri'], $matches)) {
            continue;
        }

        if (count($matches[1]) !== count($ids)) {
            continue;
        }

        $resolvedUri = $router['uri'];

        foreach ($ids as $id) {
            $resolvedUri = preg_replace($this->pattern, $id, $resolvedUri, 1);
        }
        if ($resolvedUri === $url) {
            $router['params'] = array_merge(
                $router['params'] ?? [],
                $this->getParams($matches[1], $ids)
            );

            return $router;
        }
    }



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

    protected function getParams(array $params, array $ids): array
    {
        $result = [];

        foreach ($params as $index => $param) {
            $id = $ids[$index];

            $model = $this->container->get('db')->model($param);

            if ($model) {
                $result[$param] = $model->find($id);
            } else {
                $result[$param] = $id;
            }
        }

        return $result;
    }

}