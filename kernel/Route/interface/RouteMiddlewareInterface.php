<?php

namespace Kernel\Route\interface;

interface RouteMiddlewareInterface
{
    public function __construct();

    public function getMiddleware($name);
}