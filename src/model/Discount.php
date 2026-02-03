<?php
namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\HasMany;

class Discount extends Model
{
    protected string $table = 'discounts';
    const TYPES = [
        'percentage' => 'Percentage',
        'fixed' => 'Fixed'
    ];
    protected array $fillable = [
        'name',
        'description',
        'type',
        'min_order_amount',
        'started_at',
        'finished_at',
        'is_active',
        'value'
    ];
}