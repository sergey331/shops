<?php

namespace Shop\model;

use Kernel\Model\Model;

class Option extends Model
{
    protected string $table = 'options';
    protected array $fillable = [
        "variant_name",
        "value",
        "price"
    ];
}