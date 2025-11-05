<?php

namespace Shop\controllers;

use Kernel\Controller\BaseController;
use Exception;

class AboutController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('About.Index', [
            'title' => 'About Us',
            'about' => $this->model('about')->first()
        ]);

    }
}