<?php
namespace Seeder;
use Kernel\Seeder\Seeder;

class RegionSeed extends Seeder
{
    public static function run(): void
    {
        $regions = [
            ['name' => 'Aragatsotn'],
            ['name' => 'Ararat'],
            ['name' => 'Armavir'],
            ['name' => 'Gegharkunik'],
            ['name' => 'Kotayk'],
            ['name' => 'Lori'],
            ['name' => 'Shirak'],
            ['name' => 'Syunik'],
            ['name' => 'Tavush'],
            ['name' => 'Vayots Dzor'],
            ['name' => 'Yerevan']
        ];

        foreach ($regions as $region) {
            model('Region')->create($region);
        }
    }
}