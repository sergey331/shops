<?php

namespace Shop\model;

use Kernel\Model\Model;

class ProductOption extends Model
{
    protected string $table = 'product_options';
    protected array $fillable = [
        "product_id",
        "variant_name",
        "value",
        "price"
    ];
}