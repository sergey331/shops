<?php

namespace Shop\model;

use Kernel\Model\Model;

class News extends Model
{
    protected string $table = 'news';
    protected array $fillable = [
        "title",
        "slug",
        "content",
        "image_url",
        "published_at",
        "is_published"
    ];
}