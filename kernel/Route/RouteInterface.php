<?php

namespace Kernel\Route;

use Closure;

interface RouteInterface
{

    public function __construct();

    public static function get(string $uri,$action,array $params = []);
    public static function post(string $uri, $action, array $params = []);
    public static function put(string $uri,$action,array $params = []);
    public static function delete(string $uri,$action,array $params = []);


    public static function group(array $params, Closure $callback);
}