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

        $category_id = request()->get('category_id');
        $posts = model('post')->with(['category'])->paginate()->appends(['category_id'=> $category_id]);


        $this->view()->load('Blog.Index', [
            'title' => 'Blog',
            'posts' => $posts,
            'categories' => model('Category')->get(),
            'tags' => model('Tag')->get()
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