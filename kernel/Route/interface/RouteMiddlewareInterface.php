<?php

namespace Kernel\Route\interface;

interface RouteMiddlewareInterface
{
    public function __construct(array $selectedMiddleware);

    public function resolve($container): bool;
}