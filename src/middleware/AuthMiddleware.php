<?php

namespace Shop\middleware;

use Kernel\Route\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle()
    {

        return false;
    }
}