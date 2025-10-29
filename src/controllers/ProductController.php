<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;

class ProductController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Product.Index', [
            'title' => 'Product',
        ]);

    }
}