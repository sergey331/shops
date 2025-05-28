<?php

namespace Shop\model;

use Kernel\Model\Model;

class Product extends Model
{
    protected string $table = 'products';

    protected array $with = ['discount', 'options', 'images'];
    public static $satatus = [
        'active',
        'inactive',
        'draft'
    ];
    protected array $fillable = [
        "name",
        "description",
        "sku",
        "price",
        "sale_price",
        "quantity",
        "status",
        "featured".
        "category_id",
        "brand_id",
        "image_url"
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
    public function discount()
    {
        return $this->hasOne(ProductDiscount::class);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}