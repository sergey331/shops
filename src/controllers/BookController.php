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
        $basePath = public_path("uploads/books/{$book->id}");

        $images = array_merge(
            [['path' => "{$basePath}/{$book->cover_image}"]],
            array_map(
                fn ($image) => ['path' => "{$basePath}/images/{$image->image_path}"],
                $book->images
            )
        );
        $this->view()->load('Book.Index', [
            'title' => 'Book',
            'book' => $book,
            'images' => $images
        ]);

    }
}