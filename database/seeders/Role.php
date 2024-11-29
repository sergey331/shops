<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role as ModelsRole;
class Role extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'user'],
        ];
        foreach ($roles as $role) {
            ModelsRole::create($role);
        }
    }
}
