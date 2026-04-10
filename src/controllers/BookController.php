<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Shop\model\Book;

class BookController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(Book $book): void
    {
        $book->with(['reviews']);
        $basePath = public_path("uploads/books/{$book->id}");

        $images = array_merge(
            [['path' => "{$basePath}/{$book->cover_image}"]],
            array_map(
                fn ($image) => ['path' => "{$basePath}/images/{$image->image_path}"],
                $book->images
            )
        );
        $reviews = $book->reviews()->orderBy('id','DESC')->get();
        $this->view()->load('Book.Index', [
            'title' => 'Book',
            'book' => $book,
            'images' => $images,
            'review_count'=> count($book->reviews),
            'review_content' => $this->view()->getHtml('Component.Book.Reviews',['reviews' => $reviews])
        ]);

    }
}