<?php

namespace Shop\model;

use Kernel\Model\Model;

class Slider extends Model
{
    protected string $table = 'sliders';

    protected array $fillable = [
        'title',
        'content',
        'image_url',
        'is_show',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}