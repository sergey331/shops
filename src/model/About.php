<?php

namespace Shop\model;

use Kernel\Model\Model;

class About extends Model
{
    protected string $table = 'about';
    protected array $fillable = [
        'content',
        'media_path',
        'media_type',
    ];
}