<?php
namespace Seeder;
use Kernel\Seeder\Seeder;

class GeoZoneSeed extends Seeder
{
    public static function run(): void
    {
        $zones = [
            'Yerevan' => 'express',
            'Kotayk' => 'express',
            'Ararat' => 'standard',
            'Armavir' => 'standard',
            'Aragatsotn' => 'standard',
            'Gegharkunik' => 'standard',
            'Lori' => 'standard',
            'Shirak' => 'standard',
            'Syunik' => 'standard',
            'Tavush' => 'standard',
            'Vayots Dzor' => 'standard',
        ];

        foreach ($zones as $regionName => $shippingCode) {
            $region = model('Region')->where(['name' => $regionName])->first();
            if (!$region) {
                $region = model('Region')->create(['name' => $regionName]);
            }

            $shippingMethod = model('ShippingMethod')->where(['code' => $shippingCode])->first();
            if (!$shippingMethod) {
                continue;
            }

            $payload = [
                'region_id' => $region->id,
                'shipping_method_id' => $shippingMethod->id,
            ];

            $geoZone = model('GeoZone')->where(['region_id' => $region->id])->first();
            if ($geoZone) {
                $geoZone->update($payload);
            } else {
                model('GeoZone')->create($payload);
            }
        }
    }
}