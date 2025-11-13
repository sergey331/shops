<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Shop\model\Post;
use Shop\service\PostsService;

class BlogController extends BaseController
{
    private PostsService $postsService;

    public function __construct()
    {
        $this->postsService = new PostsService();
    }

    /**
     * @throws Exception
     */
    public function index(): void
    {
        [$posts,$filteredData] = $this->postsService->getFilteredPosts();
        $this->view()->load('Blog.Index', [
            'title' => 'Blog',
            'posts' => $posts,
            'filteredData' => $filteredData,
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