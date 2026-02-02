<?php

namespace Kernel\Route;

use Kernel\Container\Container;
use Kernel\Request\interface\RequestInterface;
use Kernel\Route\interface\RouteActionInterface;

class RouteAction implements RouteActionInterface
{
    protected string $pattern = '/\{([^}]+)\}/';
    private RouteConfig|null $route = null;
    private array $staticRoutes = [];
    private array $dynamicRoutes = [];
    private string $method = '';
    private string $url = '';
    public function __construct(
        protected Container $container
    ) {
        $request = $this->container->get('request');
        $this->method = $request->getMethod();
        $this->url = $request->getUri();
    }

    public function getAction(array $routers)
    {
        /* @var RequestInterface $request */

        $this->flattenRoutes($routers);

        $this->resolveRoute();
        return $this->route;
    }

    protected function flattenRoutes(array $routers): void
    {
        $flatRouters = [];

        foreach ($routers as $router) {
            if (is_array($router) && isset($router[0]) && is_array($router[0])) {
                foreach ($router as $route) {
                    $flatRouters[] = $route;
                }
            } else {
                $flatRouters[] = $router;
            }
        }

        foreach ($flatRouters as $router) {
            /** @var RouteConfig $router */
            if ($router->getMethod() !== $this->method) {
                continue;
            }
            if (!str_contains($router->getUri(), '{')) {
                $this->setStaticRoute($router);
            } else {
                $this->setDynamicRoute($router);
            }
        }
    }

    private function setDynamicRoute($router): void
    {
        $this->dynamicRoutes[] = $router;
    }
    private function setStaticRoute($router): void
    {
        $this->staticRoutes[$router->getUri()] = $router;
    }
    private function resolveRoute(): void
    {
        $url = strlen($this->url) > 1 ? rtrim($this->url, '/') : $this->url;
        if (isset($this->staticRoutes[$url])) {
            $this->route = $this->staticRoutes[$url];
            return;
        }

        $segments = explode('/', trim($url, '/'));

        // numeric values from URL
        $ids = array_values(array_filter($segments, 'is_numeric'));

        foreach ($this->dynamicRoutes as $router) {

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

                $this->route = $router;
            }
        }
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