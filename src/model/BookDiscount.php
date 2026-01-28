<?php
namespace Shop\model;

use Kernel\Model\Model;

class BookDiscount extends Model
{
    protected string $table = 'book_discounts';
    const TYPES = [
        'percentage' => 'Percentage',
        'fixed' => 'Fixed'
    ];
    protected array $fillable = [
        'book_id',
        'price',
        'started_at',
        'finished_at',
        'type' 
    ];
}