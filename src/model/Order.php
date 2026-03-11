<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;
use Kernel\Model\Relations\HasMany;

class Order extends Model
{
    protected string $table = 'orders';

    protected array $with = [
        'shippingMethod',
        'shippingMethodItem',
        'paymentMethod',
        'address',
        'books'
    ];
    protected array $fillable = [
        'first_name',
        'last_name',
        'email',
        'address_id',
        'user_id',
        'payment_id',
        'shipping_id',
        'shipping_item_id',
        'status_id',
        'subtotal',
        'discounted',
        'total'
    ];

    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_id');
    }
    public function shippingMethodItem(): BelongsTo
    {
        return $this->belongsTo(ShippingMethodItem::class, 'shipping_item_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(OrderBook::class,'order_id');
    }
}