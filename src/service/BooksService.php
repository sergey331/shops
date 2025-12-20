<?php

namespace Shop\service;

use Kernel\Form\Form;
use Kernel\Table\Table;

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

    public function getForms() 
    {
        $errors = session()->getCLean('errors') ?? [];
        $form  = new Form('/books/store','POST', ['enctype' => 'multipart/form-data',"class" => 'form-html'],$errors);
        $form->setInput('title','Title',[
            'class' => 'form-control'
        ]);
        $form->setInput('slug','Slug',[
            'class' => 'form-control',
        ]);

        $form->setSelect('publisher_id', 'Publisher',model('Publisher')->get(),[
            'class' => 'form-control',
            'option_default_label' => "Select Publishor"
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