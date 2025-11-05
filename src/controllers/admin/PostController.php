<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\Post;
use Shop\service\PostsService;

class PostController extends BaseController
{
    private PostsService $postsService;

    public function __construct()
    {
        $this->postsService = new PostsService();
    }
    public function index(): void
    {
        $this->view()->load('Admin.Post.Index', [
            'posts' => $this->postsService->getPosts(),
        ], 'admin');
    }

    public function create(): void
    {
        $this->view()->load('Admin.Post.Create', [
            'tags' => model('tag')->get(),
            'categories' => model('category')->get(),
        ], 'admin');
    }

    public function store(): void
    {
        if (!$this->postsService->store()) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/posts');
    }

    public function edit(Post $post)
    {
        $this->view()->load('Admin.Post.Edit', [
            'post' => $post
        ], 'admin');
    }

    public function update(Post $post)
    {
        if (!$this->postsService->update($post)) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/posts');
    }

    public function delete(Post $post)
    {
        $this->postsService->delete($post);

        $this->redirect()->to('/admin/posts');
    }
}