<?php

namespace Kernel\Route;

use Closure;
use Kernel\Route\interface\RouteInterface;

class Route implements RouteInterface
{
    private static array $routers = [];
    private static string $currentPrefix = '';
    private static bool $is_prefix = false;
    private static bool $is_group = false;
    private static array $currentMiddleware = [];

    public static function get(string $uri, $action, array $params = []): void
    {
        self::addRoute('GET', $uri, $action, $params);
    }

    public static function post(string $uri, $action, array $params = []): void
    {
        self::addRoute('POST', $uri, $action, $params);
    }

    public static function put(string $uri, $action, array $params = []): void
    {
        self::addRoute('PUT', $uri, $action, $params);
    }

    public static function delete(string $uri, $action, array $params = []): void
    {
        self::addRoute('DELETE', $uri, $action, $params);
    }

    public static function group(array|Closure $params, ?Closure $callback = null): void
    {
        if (is_array($params)) {
            $previousPrefix = self::$currentPrefix;
            $previousMiddleware = self::$currentMiddleware;

            if (isset($params['prefix'])) {
                self::$is_prefix = true;
                self::$currentPrefix .= rtrim($params['prefix'], '/');
            }

            if (isset($params['middleware']) || !empty( self::$currentMiddleware)) {
                self::$is_group = true;
                self::$currentMiddleware = array_merge(self::$currentMiddleware, $params['middleware'] ?? []);
            }

            $callback();

            self::$currentPrefix = $previousPrefix;
            self::$currentMiddleware = $previousMiddleware;
        } elseif ($params instanceof Closure) {
            $params();
        }

        self::$is_prefix = false;
        self::$is_group = false;
    }

    public static function middleware(array $middleware): self
    {
        self::$is_group = true;
        self::$currentMiddleware = array_merge(self::$currentMiddleware, $middleware);
        return new self();
    }

    public static function prefix(string $prefix): self
    {
        self::$is_prefix = true;
        self::$currentPrefix .= rtrim($prefix, '/');
        return new self();
    }

    public static function getRoutes(): array
    {
        return self::$routers;
    }

    private static function formatUri(string $uri): string
    {
        $uriPath = self::$is_prefix ? self::$currentPrefix . $uri : $uri;
        return strlen($uriPath) > 1 ? rtrim($uriPath, '/') : $uriPath;
    }

    private static function addRoute(string $method, string $uri, $action, array $params): void
    {
        self::$routers[] =  new RouteConfig(
            strtoupper($method),
            self::formatUri($uri),
            $action,
            $params,
            self::$is_group ? ['middleware' => self::$currentMiddleware] : []
        );
    }
}
