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
        $featuredProduct = model('product')->where(['featured' => 1])->get();
        $sliders = model('slider')->where(['is_show' => 1])->get();

        $this->view()->load('Home.Index', [
            'featuredProducts' => $featuredProduct,
            'sliders' => $sliders,
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