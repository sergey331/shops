<?php

namespace Kernel\Route\interface;

use Kernel\Container\Container;

interface RouteControllerInterface
{
    public function __construct(
        array|\Closure|null $actions,
        array $params,
        Container $container
    );

    public function resolve(): void;
}