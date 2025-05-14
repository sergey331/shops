<?php

namespace Shop\model;

use Kernel\Model\Model;

class Category extends Model
{
    protected string $table = 'categories';
    protected array $with = ['childrens'];

    protected array $fillable = [
        'name',
        'description',
        'avatar',
        'category_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function childrens()
    {
        return $this->hasMany(Category::class);
    }
}