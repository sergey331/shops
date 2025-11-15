<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;

class HomeController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {

        $this->view()->load('Home.Index', [
            'sliders' => model('slider')->where(['is_show' => 1])->get(),
            'categories' => model('category')->get(),
        ]);
    }
}