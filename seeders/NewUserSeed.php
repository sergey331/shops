<?php

namespace Seeder;
use Kernel\Seeder\Seeder;

class NewUserSeed extends Seeder
{
    public function run()
    {
        $this->model('User')->create([
            'username' => 'New User',
            'email' => 'new@user.de',
            'password' => '123456',
            'is_admin' => 0
        ]);
    }
}