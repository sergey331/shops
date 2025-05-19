<?php

namespace Shop\model;

use Kernel\Model\Model;

class ProductDiscount extends Model
{
    protected string $table = "product_discounts";

    protected array $fillable = [
        "product_id",
        "discount_type",
        "discount_value",
        "start_date",
        "end_date",
        "is_active"
    ];
}