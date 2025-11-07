<?php

namespace Shop\model;

use Kernel\Model\Model;

class PostTag extends Model
{
    protected string $table = 'post_tags';
    protected array $fillable = [
        'post_id',
        'tag_id'
    ];
}