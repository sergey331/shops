<?php
namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\BelongsTo;

class Setting extends Model
{
    protected string $table = 'settings';
    protected array $with = ['currency'];
    const  THEME = [
        'light' => 'Light',
        'dark' => "Dark"
    ];
    protected array $fillable = [
        'email',
        'phone',
        'address',
        'logo',
        'default_discount_days',
        'currency_id',
        'theme'
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}