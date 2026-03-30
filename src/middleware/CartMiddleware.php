<?php

namespace Shop\middleware;

use Exception;
use Kernel\Container\Container;
use Kernel\Route\interface\MiddlewareInterface;
use Kernel\Route\Middleware;

class CartMiddleware extends Middleware implements MiddlewareInterface
{
    public function __construct(Container $container) {
       parent::__construct($container);
    }

    /**
     * @throws Exception
     */
    public function handle(): true
    {
        $isAjax = !empty(request()->getRequested())
            && strtolower(request()->getRequested()) === 'xmlhttprequest';

        if (!$isAjax && empty(cart()->get())) {
            $this->redirect()->to('/shop');
        }

        return true;
    }

}