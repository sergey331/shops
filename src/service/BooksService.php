<?php

namespace Shop\service;

class BooksService
{
    public function getBooks()
    {
        return model('Book')->with(['publisher'])->paginate();
    }
}