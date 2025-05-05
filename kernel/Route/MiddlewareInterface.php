<?php

namespace Kernel\Route;

use Kernel\Container\Container;

interface MiddlewareInterface
{
    public function __construct(Container $container);
    public function handle();
}