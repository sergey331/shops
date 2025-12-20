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

        $forms = $this->productService->getForms();


        $tags = $this->model('Tag')->get();
        $this->view()->load('Admin.Book.Create',[
            'languages' => $this->model('Language')->get(),
            'publishers' => $this->model('Publisher')->get(),
            'authors' => $this->model('Author')->get(),
            'statuses' => ['draft','published','archived'],
            'categories' => $this->model('Category')->get(),
            'tags' => $tags,
            'forms' => $forms
        ], 'admin');
    }

    public function store() 
    {

    }
}