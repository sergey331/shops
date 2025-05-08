<?php

namespace Kernel\Route;

use Closure;

class Route implements RouteInterface
{

    public function __construct()
    {
    }

    public static function get(string $uri, $action, array $params = []): array
    {
        return [
            'method' => 'GET',
            'uri' => $uri,
            'action' => $action,
            'params' => $params,
        ];
    }

    public static function post(string $uri, $action, array $params = []): array
    {
        return [
            'method' => 'POST',
            'uri' => $uri,
            'action' => $action,
            'params' => $params,
        ];
    }
    public static function put(string $uri, $action, array $params = []): array
    {
        return [
            'method' => 'PUT',
            'uri' => $uri,
            'action' => $action,
            'params' => $params,
        ];
    }
    public static function delete(string $uri, $action, array $params = []): array
    {
        return [
            'method' => 'PUT',
            'uri' => $uri,
            'action' => $action,
            'params' => $params,
        ];
    }

    public static function group(array $params, Closure $callback): array
    {
        $prefix = $params['prefix'] ?? '';
        unset($params['prefix']);
        $router = new static(); 

        $groupRoutes = $callback($router);
        $result = [];
        foreach ($groupRoutes as $route) {
            $route['uri'] =rtrim($prefix . $route['uri'], '/');
            $route['group'] = $params;
            $result[] = $route;
        }
        return $result;
    }
}
