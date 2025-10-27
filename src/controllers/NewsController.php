<?php

namespace Shop\controllers;

use Kernel\Controller\BaseController;
use Shop\service\NewsService;

class NewsController extends BaseController
{
    private NewsService $newsService;
    public function __construct()
    {
        $this->newsService = new NewsService();
    }
    public function index()
    {
        $this->view()->load("News.Index", [
            'news' => $this->newsService->getNews(),
        ]);
    }

    public function show($slug) 
    {
        $this->view()->load("News.Show", [
            'new' => $this->newsService->getNewBySlug($slug),
        ]);
    }
}