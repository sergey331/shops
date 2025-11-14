<?php

namespace Shop\model;

use Kernel\Model\Model;

class Publisher extends Model
{
    protected string $table = 'publishers';
    protected array $fillable = [
        'name',
        'slug',
        'website',
        'email',
        'phone',
        'address',
        'bio'
    ];
}