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
        $data = $this->productService->getBooks();
        $this->view()->load('Admin.Book.Index', [
            'books' => $data['books'],
            'tableData' => $data['tableData'],
        ], 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.Book.Create',[
            'languages' => $this->model('Language')->get(),
            'publishers' => $this->model('Publisher')->get(),
            'authors' => $this->model('Author')->get(),
        ], 'admin');
    }
}