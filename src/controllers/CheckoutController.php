<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;

class CheckoutController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Checkout.Index', [
            'title' => 'Checkout',
        ]);

    }
}