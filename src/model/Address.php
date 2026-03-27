<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;

class Address extends Model
{
    protected string $table = 'address';
    protected array $with = ['region'];
    protected array $fillable = [
        'phone',
        'region_id',
        'city',
        'address',
        'address1',
        'zip'
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}