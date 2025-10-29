<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;

class BlogController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Blog.Index', [
            'title' => 'Blog',
        ]);
    }

    public function show($id)
    {

        $this->view()->load('Blog.Show', [
            'title' => 'Single Blog',
        ]);
    }
}