<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;

class GeoZone extends Model
{
    protected string $table = 'geo_zones';
    protected array $fillable = [
        'region_id',
        'shipping_method_id'
    ];

    protected array $with = ['region','shippingMethod'];
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }
}