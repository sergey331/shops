<?php

namespace Shop\model;

use Kernel\Model\Model;

class CartItem extends Model
{
    protected string $table = 'cart_items';
    protected array $fillable = [
        'cart_id',
        'book_id',
        'quantity'
    ];
}