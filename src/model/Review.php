<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;

class Review extends Model
{
    protected string $table = 'reviews';
    protected array $with = ['user'];
    protected array $fillable = [
        'book_id',
        'user_id',
        'rating',
        'comment'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}