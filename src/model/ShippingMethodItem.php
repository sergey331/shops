<?php

namespace Shop\model;

use Kernel\Model\Model;

class ShippingMethodItem extends Model
{
    protected string $table = 'shipping_method_items';
    protected array $fillable = [
        'price',
        'min_price',
        'max_price',
        'shipping_method_id'
    ];
}