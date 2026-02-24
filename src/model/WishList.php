<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;

class WishList extends Model
{
    protected string $table = 'wishlists';
    protected array $with = ['book'];
    protected array $fillable = [
        'user_id',
        'book_id'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}