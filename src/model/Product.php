<?php

namespace Shop\model;

use Kernel\Model\Model;

class Product extends Model
{
    protected string $table = 'products';
    protected array $fillable = [
        "name",
        'category_id',
        'description',
        'avatar',
        'price',
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}