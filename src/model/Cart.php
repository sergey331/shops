<?php

namespace Shop\model;

use Kernel\Model\Model;

class Cart extends Model
{
    protected string $table = 'carts';
    protected array $fillable = [
        'user_id',
        'session_id'
    ];
}