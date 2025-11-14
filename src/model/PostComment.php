<?php

namespace Shop\model;

use Kernel\Model\Model;

class PostComment extends Model
{
    protected string $table = 'post_comments';
    protected array $with = ['user','children'];
    protected array $fillable = [
        'post_id',
        'user_id',
        'postcomment_id',
        'comment'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(PostComment::class);
    }
}