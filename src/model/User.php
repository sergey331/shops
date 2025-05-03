<?php

namespace Shop\model;

use Kernel\Model\Model;

class User extends Model
{
    protected string $table = 'users';

    protected array $fillable = [
        'username',
        'email',
        'password'
    ];
}