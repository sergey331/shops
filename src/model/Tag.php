<?php

namespace Shop\model;

use Kernel\Model\Model;

class Tag extends Model
{
    protected string $table = 'tags';

    protected array $fillable = [
        'name',
        'slug'
    ];
}