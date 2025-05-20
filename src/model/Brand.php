<?php

namespace Shop\model;

use Kernel\Model\Model;

class Brand extends Model
{
    protected string $table = 'brands';
    protected array $fillable = [
        "name",
    ];
}