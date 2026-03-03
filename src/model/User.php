<?php

namespace Shop\model;

use Kernel\Model\Model;
use Kernel\Model\Relations\HasMany;

class User extends Model
{
    protected string $table = 'users';

    protected array $fillable = [
        'username',
        'email',
        'password',
        'avatar',
        'is_admin',
        'remember_token',
        'first_name',
        'last_name',
        'address_id',
    ];

    public function wishLists(): HasMany
    {
        return $this->hasMany(WishList::class);
    }
}