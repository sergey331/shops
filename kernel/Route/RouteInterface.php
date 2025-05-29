<?php

namespace Kernel\Route;

use Closure;

interface RouteInterface
{
    public static function get(string $uri, $action, array $params = []): void;

    public static function post(string $uri, $action, array $params = []): void;

    public static function put(string $uri, $action, array $params = []): void;

    public static function delete(string $uri, $action, array $params = []): void;

    public static function group(array|Closure $params, Closure $callback = null): void;

    public static function middleware(array $middleware): self;

    public static function prefix(string $prefix): self;

    public static function getRoutes(): array;
}
