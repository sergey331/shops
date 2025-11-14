<?php

namespace Shop\model;

use Kernel\Model\Model;

class Post extends Model
{
    protected string $table = 'posts';
    protected array $fillable = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'views'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tags');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }
}