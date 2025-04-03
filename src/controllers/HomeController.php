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
            'title' => 'Home',
            'content' => 'Welcome to the home page!'
        ]);

    }
}