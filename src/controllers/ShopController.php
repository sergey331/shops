<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;

class ShopController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Shop.Index', [
            'title' => 'Shop',
        ]);

    }
}