<?php

namespace Shop\model;

use Kernel\Model\Model;

class Notification extends Model
{
    protected string $table = 'notifications';
    protected array $fillable = [
        'title',
        'message',
        'type',
        'item_id',
        'is_read'
    ];
}