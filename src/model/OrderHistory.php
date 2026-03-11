<?php

namespace Shop\model;

use Kernel\Model\Model;

class OrderHistory extends Model
{
    protected string $table = 'order_histories';
    protected array $fillable = [
        'notify',
        'comment',
        'status_id',
        'order_id',
    ];
}