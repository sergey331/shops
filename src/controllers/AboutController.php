<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;

class AboutController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('About.Index', [
            'title' => 'About Us',
        ]);

    }
}