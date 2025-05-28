<?php

namespace Shop\middleware;

use Kernel\Container\Container;
use Kernel\Route\Middleware;
use Kernel\Route\MiddlewareInterface;

class AuthMiddleware extends Middleware implements MiddlewareInterface
{
    public function __construct(Container $container) {
       parent::__construct($container);
    }

    public function handle()
    {
        if (!$this->auth()->check()) {
            $this->redirect()->back();
        }
        return true;
    }

}