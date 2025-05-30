<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\News;
use Shop\service\NewsService;

class NewsController extends BaseController
{
    private NewsService $newsService;

    public function __construct()
    {
        $this->newsService = new NewsService();
    }
    public function index(): void
    {
        $this->view()->load('Admin.News.Index', [
            'news' => $this->newsService->getNews(),
        ], 'admin');
    }

    public function create(): void
    {

        $this->view()->load('Admin.News.Create', [], 'admin');
    }

    public function store(): void
    {
        if (!$this->newsService->store()) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/news');
    }

    public function edit(News $new)
    {
        $this->view()->load('Admin.News.Edit', [
            'new' => $new,
        ], 'admin');
    }

    public function update(News $new)
    {
        if (!$this->newsService->update($new)) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/news');
    }

    public function delete(News $new)
    {
        $this->newsService->delete($new);

        $this->redirect()->to('/admin/news');
    }
}
