<?php

namespace Shop\middleware;

use Kernel\Container\Container;
use Kernel\Route\interface\MiddlewareInterface;
use Kernel\Route\Middleware;

class CartMiddleware extends Middleware implements MiddlewareInterface
{
    public function __construct(Container $container) {
       parent::__construct($container);
    }

    public function handle()
    {
        if (empty(cart()->get())) {
            $this->redirect()->to('/shop');
        }
        return true;
    }

}