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

    /**
     * @throws Exception
     */
    public function show($id): void
    {
        $this->view()->load('Home.Show', [
            'title' => 'Show',
            'content' => 'Welcome to the show page!'
        ]);
    }
}