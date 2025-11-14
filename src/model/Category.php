<?php

namespace Shop\model;

use Kernel\Model\Model;

class Category extends Model
{
    protected string $table = 'categories';

    protected array $fillable = [
        'name',
        'description',
        'logo',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class,'book_category');
    }
}