<?php

namespace Shop\model;

use Kernel\Model\Model;

class Product extends Model
{
    protected string $table = 'products';
    protected array $fillable = [
        "name",
        "description",
        "sku",
        "price",
        "sale_price",
        "quantity",
        "status",
        "category_id",
        "brand_id",
        "image_url"
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}