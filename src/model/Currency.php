<?php
namespace Shop\model;

use Kernel\Model\Model;

class Currency extends Model
{
    protected string $table = 'currencies';
    protected array $fillable = [
        'name',
        'code',
        'symbol',
        'exchange_rate',
        'is_default'
    ];
}