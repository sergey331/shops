<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\Book;
use Shop\model\BookImage;
use Shop\service\BooksService;

class BookController extends BaseController
{
    private BooksService $bookService;

    public function __construct()
    {
        $this->bookService = new BooksService();
    }

    public function index()
    {
        $data = $this->bookService->getBooks();
        $this->view()->load('Admin.Book.Index', [
            'books' => $data['books'],
            'tableData' => $data['tableData'],
        ], 'admin');
    }

    public function create()
    {

        $forms = $this->bookService->getForms('/admin/books/store');
        $this->view()->load('Admin.Book.Create',[
            'forms' => $forms
        ], 'admin');
    }

    public function store() 
    {
         if (!$this->bookService->store()) {
            $this->redirect()->back();
            return;
        }

        
        $this->redirect()->to('/admin/books');
    }

    public function edit(Book $book) 
    {
        $forms = $this->bookService->getForms('/admin/books/store',$book);
        $this->view()->load('Admin.Book.Edit',[
            'forms' => $forms
        ], 'admin');
    }

    public function show(Book $book) 
    {
        $this->view()->load('Admin.Book.Show',[
            'book' => $book
        ], 'admin');
    }

    public function deleteImages(BookImage $bookImage)
    {

        if (!$this->bookService->removeImage($bookImage)) {

        }
        $this->response()->json([
            'status' => true
        ]);
        
    }

    public function imageStore() 
    {
        if ($images = $this->bookService->imageStore()) {
            $this->response()->json([
                'status' => true,
                'images' => $images
            ]);
            exit;
        }
        $this->response()->json([
            'status' => false
        ]);
    }

    public function discount(Book $book) 
    {
        $discount = $this->bookService->discount($book);
        $status = 200;
        if (!$discount['success']) {
            $status = 400;
        }
        $this->response()->json($discount,$status);
    }
}