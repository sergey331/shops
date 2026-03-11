<?php
namespace Shop\model;

use Kernel\Model\Model;

class OrderStatus extends Model
{
    protected string $table = 'order_statuses';
    protected array $fillable = ['name'];
}