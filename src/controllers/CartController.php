<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;

class CartController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Cart.Index', [
            'title' => 'Cart',
        ]);

    }
}