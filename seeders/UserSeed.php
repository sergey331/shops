<?php

namespace Seeder;
use Kernel\Seeder\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        $this->model('User')->create([
            'username' => 'Admin User',
            'email' => 'admin@admin.de',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'is_admin' => 1
        ]);
    }
}