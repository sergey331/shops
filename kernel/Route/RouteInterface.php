<?php

namespace Kernel\Route;

use Closure;

interface RouteInterface
{

    public function __construct($uri,$action,$method,$params);

    public static function get($uri,$action,$params = []);
    public static function post($uri,$action,$params = []);
    public static function put($uri,$action,$params = []);
    public static function delete($uri,$action,$params = []);

    public function getRoutes();

    public static function group(array $prefix, Closure $callback);
}