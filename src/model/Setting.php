<?php
namespace Shop\model;

use Kernel\Model\Model;

class Setting extends Model
{
    protected string $table = 'settings';
    protected array $fillable = [
        'email',
        'phone',
        'address',
        'logo'
    ];
}