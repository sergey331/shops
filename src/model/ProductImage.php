<?php

namespace Shop\model;

use Kernel\Model\Model;

class ProductImage extends Model
{
    protected string $table = "product_images";

    protected $fillable = [
        "product_id",
        "url",
        "is_main"
    ];
}