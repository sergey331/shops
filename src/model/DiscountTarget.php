<?php
namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;

class DiscountTarget extends Model
{
    protected string $table = 'discount_targets';
    protected array $fillable = [
        'discount_id',
        'target_type',
        'target_id'
    ];

    public function discount(): BelongsTo 
    {
        return $this->belongsTo(Discount::class);
    }
}