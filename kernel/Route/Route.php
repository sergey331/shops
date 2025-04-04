<?php

namespace Kernel\Route;

use Closure;
use Kernel\Route\RouteInterface;

class Route implements RouteInterface
{

    private array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];


    public function __construct($url, $action,$method, $params)
    {
        $this->routes[$method][$url] = [
            'action' => $action,
            'params' => $params
            ];
    }
    public static function get($uri, $action, $params = []): static
    {
        return new static($uri, $action,'GET', $params);
    }

    public static function post($uri, $action, $params = []): static
    {
        return new static($uri, $action,"POST", $params);
    }

    public static function put($uri, $action, $params = []): static
    {
        return new static($uri, $action,"PUT" , $params);
    }

    public static function delete($uri, $action, $params = []): static
    {
        return new static($uri, $action,"DELETE", $params);
    }

    public function getRoutes(): array
    {
       return $this->routes;
    }

    public static function group(array $prefix, Closure $callback)
    {
        $callback();
    }
}