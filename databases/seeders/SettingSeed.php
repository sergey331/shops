<?php
namespace Seeder;
use Kernel\Seeder\Seeder;

class SettingSeed extends Seeder
{
    public static function run(): void
    {
        model('Setting')->create([
            'email' => 'test@test.com',
            'phone' => '077616548',
            'address' => 'test'    
        ]);
    }
}