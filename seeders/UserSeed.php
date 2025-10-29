<?php

namespace Seeder;
use Kernel\Hash\Hash;
use Kernel\Seeder\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        $this->model('User')->create([
            'username' => 'Admin User',
            'email' => 'admin@admin.de',
            'password' => 'admin123',
            'is_admin' => 1
        ]);
    }
}