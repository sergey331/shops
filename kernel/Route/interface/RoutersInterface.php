<?php

namespace Kernel\Route\interface;

use Exception;
use Kernel\Container\Container;
use Kernel\Route\interface\MiddlewareInterface;
use Kernel\Route\Route;
use Kernel\Route\RouteAction;
use Kernel\Route\RouteMiddleware;

interface RoutersInterface
{

    public function __construct(Container $container);

    public function dispatch(): void;
}