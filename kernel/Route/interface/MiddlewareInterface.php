<?php

namespace Kernel\Route\interface;

use Kernel\Container\Container;

interface MiddlewareInterface
{
    public function __construct(Container $container);
    public function handle();
}