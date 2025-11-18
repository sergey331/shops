<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;
use Kernel\Model\Relations\BelongsToMany;

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

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class,'book_author');
    }

    public function categories()
    {
        return $this->belongsToMany( Category::class, 'book_category');
    }
}