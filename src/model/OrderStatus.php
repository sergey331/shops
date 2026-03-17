<?php
namespace Shop\model;

use Kernel\Model\Model;

class OrderStatus extends Model
{
    const int PENDING_ID = 1;
    protected string $table = 'order_statuses';
    protected array $fillable = ['name'];
}