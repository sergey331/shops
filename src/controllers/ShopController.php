<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Shop\service\BooksService;

class ShopController extends BaseController
{
    private BooksService $booksService;

    public function __construct()
    {
        $this->booksService = new BooksService();
    }

    /**
     * @throws Exception
     */
    public function index(): void
    {
        $books = $this->booksService->getFilteredBooks();

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

    public function filter()
    {
        $books = $this->booksService->getFilteredBooks();
        $this->response()->html(
            $this->view()->getHtml('Shop.Books',[
                'books' => $books
            ])
        );
    }
}