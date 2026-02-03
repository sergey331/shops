<?php

namespace Kernel\Route;

use Kernel\Container\Container;
use Kernel\Request\interface\RequestInterface;
use Kernel\Route\interface\RouteActionInterface;

class RouteAction implements RouteActionInterface
{
    private RouteConfig|null $route = null;

    /** @var RouteConfig[] */
    private array $staticRoutes = [];

    /** @var array<int, array{route: RouteConfig, regex: string, params: array}> */
    private array $dynamicRoutes = [];

    private string $method;
    private string $url;

    public function __construct(
        protected Container $container
    ) {
        /** @var RequestInterface $request */
        $request = $this->container->get('request');

        $this->method = $request->getMethod();
        $this->url    = $this->normalizeUrl($request->getUri());
    }

    public function getAction(array $routers): ?RouteConfig
    {
        $this->flattenRoutes($routers);
        $this->resolveRoute();

        return $this->route;
    }

    private function normalizeUrl(string $url): string
    {
        return $url !== '/' ? rtrim($url, '/') : '/';
    }

    protected function flattenRoutes(array $routers): void
    {
        foreach ($routers as $routerGroup) {
            $routes = is_array($routerGroup) ? $routerGroup : [$routerGroup];

            foreach ($routes as $route) {
                /** @var RouteConfig $route */
                if ($route->getMethod() !== $this->method) {
                    continue;
                }

                $uri = $this->normalizeUrl($route->getUri());

                if (!str_contains($uri, '{')) {
                    $this->staticRoutes[$uri] = $route;
                } else {
                    $this->registerDynamicRoute($route, $uri);
                }
            }
        }
    }

    private function registerDynamicRoute(RouteConfig $route, string $uri): void
    {
        preg_match_all('/\{([^}]+)\}/', $uri, $matches);

        $paramNames = $matches[1];

        $regex = preg_replace(
            '/\{[^}]+\}/',
            '([^\/]+)',
            $uri
        );

        $this->dynamicRoutes[] = [
            'route'  => $route,
            'regex'  => '#^' . $regex . '$#',
            'params' => $paramNames,
        ];
    }

    private function resolveRoute(): void
    {
        /** Static routes (O(1)) */
        if (isset($this->staticRoutes[$this->url])) {
            $this->route = $this->staticRoutes[$this->url];
            return;
        }

        /** Dynamic routes */
        foreach ($this->dynamicRoutes as $item) {
            if (!preg_match($item['regex'], $this->url, $matches)) {
                continue;
            }
            array_shift($matches);
            $params = $this->resolveParams($item['params'], $matches);
            $item['route']->setParams($params);
            $this->route = $item['route'];
            return;
        }
    }

    private function resolveParams(array $names, array $values): array
    {
        $result = [];
        $db = $this->container->get('db');
        foreach ($names as $index => $name) {
            $value = $values[$index];

            $model = $db->model($name);
            $result[$name] = $model ? $model->find($value) : $value;
        }
        return $result;
    }
}
