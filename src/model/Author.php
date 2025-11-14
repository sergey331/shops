<?php

namespace Shop\model;

use Kernel\Model\Model;

class Author extends Model
{
    protected string $table = 'authors';
    protected array $fillable = [
        'name',
        'slug',
        'bio',
        'photo'
    ];
}