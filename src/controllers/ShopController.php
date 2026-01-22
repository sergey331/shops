<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Shop\service\BooksService;

class ShopController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $books = (new BooksService())->getFilreredBooks();

        $authors = model('Author')->get();
        $categories = model('Category')->get();
        $tags = model('Tag')->get();
        $this->view()->load('Shop.Index', [
            'title' => 'Shop',
            'books' => $books,
            'authors' => $authors,
            'categories' => $categories,
            'tags' => $tags
        ]);

    }
}