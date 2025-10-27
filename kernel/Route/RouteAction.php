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
    $id = end($segments);

    foreach ($dynamicRoutes as $router) {
        preg_match($this->pattern, $router['uri'], $matches);
        if (!empty($matches)) {
            // Optional: validate $id format here if needed
            $router['uri'] = preg_replace($this->pattern, $id, $router['uri']);
            $param = $this->getParams($matches[1], $id);
            $router['params'] = array_merge($router['params'], $param);

            if ($router['uri'] === $url) {
                return $router;
            }
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

    protected function getParams($param,$id)  
    {
        $model = $this->container->get('db')->model($param);

        if ($model) {
            return [$model->find($id)];
        }

        return [$param => $id];

    }
}