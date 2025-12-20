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
        $data = $this->postsService->getPosts();
        $this->view()->load('Admin.Post.Index', [
            'posts' => $data['posts'],
            'tableData' => $data['tableData'],
        ], 'admin');
    }

    public function create(): void
    {
        $this->view()->load('Admin.Post.Create', [
            'form' => $this->postsService->getForms('/admin/posts/store')
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
        
        $post->with(['tags']);

        $this->view()->load('Admin.Post.Edit', [
             'form' => $this->postsService->getForms("/admin/posts/{$post->id}",$post)
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