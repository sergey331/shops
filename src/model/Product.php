<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;
use Kernel\Model\Relations\HasMany;
use Kernel\Model\Relations\HasOne;

class Product extends Model
{
    /**
     * @var mixed|null
     */
    public mixed $image_url;
    protected string $table = 'products';
    public static array $status = [
        'active',
        'inactive',
        'draft'
    ];
    protected array $fillable = [
        "name",
        "description",
        "sku",
        "price",
        "sale_price",
        "quantity",
        "status",
        "featured",
        "category_id",
        "brand_id",
        "image_url"
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function discount(): HasOne
    {
        return $this->hasOne(ProductDiscount::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}