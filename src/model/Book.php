<?php

namespace Shop\model;

use Kernel\Model\Model;

class Book extends Model
{
    protected string $table = 'books';

    protected array $fillable = [
        'title',
        'slug',
        'description',
        'isbn',
        'language',
        'pages',
        'price',
        'discount_price',
        'stock',
        'cover_image',
        'publisher_id',
        'publication_date',
        'rating',
        'featured',
        'status',
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function categories()
    {
        return $this->belongsToMany( Category::class, 'book_category');
    }
}