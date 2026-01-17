<?php

namespace Shop\model;

use JsonSerializable;
use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;

class BookImage extends Model implements JsonSerializable
{
    protected string $table = 'book_images';


    protected array $fillable = [
        'image_path',
        'is_primary',
        'book_id'
    ];

    public function book(): BelongsTo   
    {
        return $this->belongsTo(Book::class);
    }

    public function jsonSerialize(): mixed
    {
        return $this->data;
    }
}