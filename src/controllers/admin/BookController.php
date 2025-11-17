<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\service\BooksService;

class BookController extends BaseController
{
    private BooksService $productService;

    public function __construct()
    {
        $this->productService = new BooksService();
    }

    public function index()
    {
        $this->view()->load('Admin.Book.Index', [
            'books' => $this->productService->getBooks(),
        ], 'admin');
    }
}