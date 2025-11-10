<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Shop\model\Post;

class BlogController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Blog.Index', [
            'title' => 'Blog',
            'posts' => model('post')->with(['category'])->get()
        ]);
    }

    public function show(Post $post)
    {
        $post->with(['category','tags']);
        $this->view()->load('Blog.Show', [
            'title' => 'Single Blog',
            'post' => $post
        ]);
    }
}