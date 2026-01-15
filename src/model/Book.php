<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;
use Kernel\Model\Relations\BelongsToMany;
use Kernel\Model\Relations\HasMany;
use Kernel\Model\Relations\HasOne;

class Book extends Model
{
    protected string $table = 'books';

    protected array $with = ['authors','categories','tags', 'language'];

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

    public function language(): BelongsTo   
    {
        return $this->belongsTo(Language::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class,'book_author');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany( Category::class, 'book_category');
    }

    public function tags(): BelongsToMany 
    {
        return $this->belongsToMany( Tag::class, 'book_tag');
    }

    public function images(): HasMany 
    {
        return $this->hasMany(BookImage::class);
    }
}