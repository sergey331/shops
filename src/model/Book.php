<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;
use Kernel\Model\Relations\BelongsToMany;
use Kernel\Model\Relations\HasOne;

class Book extends Model
{
    protected string $table = 'books';

    protected array $fillable = [
        'title',
        'slug',
        'description',
        'isbn',
        'language_id',
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

    public function language(): HasOne   
    {
        return $this->hasOne(Language::class);
    }

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