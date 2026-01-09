<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;

class BookImage extends Model
{
    protected string $table = 'book_images';

    protected array $with = ['authors','categories','tags'];

    protected array $fillable = [
        'image_path',
        'is_primary',
        'book_id'
    ];

    public function book(): BelongsTo   
    {
        return $this->belongsTo(Book::class);
    }
}