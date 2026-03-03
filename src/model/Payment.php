<?php

namespace Shop\model;

use Kernel\Model\Model;

class Payment extends Model
{
    protected string $table = 'payments';
    protected array $fillable = [
        'code',
        'name',
        'description',
        'icon',
        'sort_order'
    ];
}