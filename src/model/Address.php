<?php

namespace Shop\model;

use Kernel\Model\Model;

class Address extends Model
{
    protected string $table = 'address';
    protected array $fillable = [
        'phone',
        'region_id',
        'city',
        'address',
        'address1',
        'zip'
    ];
}