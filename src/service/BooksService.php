<?php

namespace Shop\service;

use Kernel\Form\Form;
use Kernel\Table\Table;
use Shop\model\Book;

class BooksService
{
    public function getBooks()
    {
        $books = model('Book')->with(['publisher','authors','categories'])->paginate();
        return [
            'books' => $books,
            'tableData' => $this->getTableData($books)
        ];
    }

    public function getForms(string $url, ?Book $book = null) 
    {
        $errors = session()->getCLean('errors') ?? [];
        $form  = new Form($url,'POST', ['enctype' => 'multipart/form-data',"class" => 'form-html'],$errors);
        $form->stepe('general', callback: function ($f){
            $f->setInput('title','Title',[
                'class' => 'form-control',
                'value' => $book->title ?? ''
            ]);
            $f->setInput('slug','Slug',[
                'class' => 'form-control',
                'value' => $book->slug ?? ''
            ]);
        });
        $form->stepe('price', callback: function ($f){
            $f->setNumber('price','Price',[
                'class' => 'form-control',
                'value' => $book->price ?? ''
            ]);
            $f->setNumber('discount_price','Discount Price',[
            'class' => 'form-control',
            'value' => $book->discount_price ?? ''
        ]);
        });
        $form->setInput('isbn','Isbn',[
            'class' => 'form-control',
            'value' => $book->isbn ?? ''
        ]);
        
        $form->setNumber('pages','Pages',[
            'class' => 'form-control',
            'value' => $book->pages ?? ''
        ]);
        

        $form->setFile('cover_image','Cover Image',[
            'class' => 'form-control'
        ]);
        $form->setTextarea('description','Description',[
            'class' => 'form-control',
            'value' => $book->description ?? ''
        ]);

        $form->setSelect('publisher_id', 'Publisher',model('Publisher')->get(),[
            'class' => 'form-control',
            'option_default_label' => "Select Publishor",
            'value' => $book->publisher_id ?? ''
        ]);

         $form->setDate('publication_date','Publication Date',[
            'class' => 'form-control',
            'value' => $book->publication_date ?? ''
        ]);

        $form->setCheckbox('stock','Stock',[
            'class' => 'form-check-input',
            'checked' => isset($book->stock) ? (bool)$book->stock : '',
            'value' => 1
        ]);
        return $form;
    }

    private function getTableData($books)
    {
        $table = new Table($books->data,[
            "#" => ['field' => 'id'],
            "Title" => ['field' => 'title'],
            "Slug" => ['field' => 'slug'],
            "Description" => ['field' => 'description'],
            "Isbn" => ['field' => 'isbn'],
            "Language" => ['field' => 'language'],
            "Pages" => ['field' => 'pages'],
            "Price" => ['field' => 'price'],
            "Publisher" => ['field' => 'publisher.name'],
            "Authors" => ['field' => 'authors.*.name'],
            "Categories" => ['field' => 'categories.*.name'],
            "Status" => ['field' => 'status'],
            "Actions" => [
                'callback' => function($row) {
                    $id = $row->id;
                    return '
                        <a href="/admin/books/'.$id.'" class="btn btn-sm btn-primary">Edit</a>
                        <a href="/admin/books/delete/'.$id.'" class="btn btn-sm btn-danger">Delete</a>
                    ';
                },
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}