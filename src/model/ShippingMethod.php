<?php
namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\HasMany;

class ShippingMethod extends Model
{
    protected string $table = 'shipping_methods';
    protected array $with = ['items'];
    protected array $fillable = [
        'code',
        'name',
        'icon',
        'enabled'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ShippingMethodItem::class,'shipping_method_id');
    }
}