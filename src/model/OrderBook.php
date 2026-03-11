<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;

class OrderBook extends Model
{
    protected string $table = 'order_books';
    protected array $with = ['book'];
    protected array $fillable = [
        'book_id',
        'name',
        'price',
        'quantity',
        'order_id'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}