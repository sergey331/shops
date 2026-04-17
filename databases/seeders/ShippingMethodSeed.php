<?php
namespace Seeder;
use Kernel\Seeder\Seeder;

class ShippingMethodSeed extends Seeder
{
    public static function run(): void
    {
        $methods = [
            [
                'code' => 'standard',
                'name' => 'Standard Shipping',
                'icon' => null,
                'enabled' => 1,
            ],
            [
                'code' => 'express',
                'name' => 'Express Shipping',
                'icon' => null,
                'enabled' => 1,
            ],
            [
                'code' => 'pickup',
                'name' => 'Store Pickup',
                'icon' => null,
                'enabled' => 1,
            ],
        ];

        foreach ($methods as $method) {
            $shippingMethod = model('ShippingMethod')->where(['code' => $method['code']])->first();

            if ($shippingMethod) {
                $shippingMethod->update($method);
            } else {
                $shippingMethod = model('ShippingMethod')->create($method);
            }

            self::seedItems((int)$shippingMethod->id, $method['code']);
        }
    }

    private static function seedItems(int $shippingMethodId, string $code): void
    {
        $itemsByMethod = [
            'standard' => [
                ['price' => 1200, 'min_price' => 0, 'max_price' => 9999],
                ['price' => 0, 'min_price' => 10000, 'max_price' => null],
            ],
            'express' => [
                ['price' => 2500, 'min_price' => 0, 'max_price' => 14999],
                ['price' => 1200, 'min_price' => 15000, 'max_price' => null],
            ],
            'pickup' => [
                ['price' => 0, 'min_price' => 0, 'max_price' => null],
            ],
        ];

        foreach ($itemsByMethod[$code] ?? [] as $item) {
            $payload = $item + ['shipping_method_id' => $shippingMethodId];
            $existingItem = model('ShippingMethodItem')->where([
                'shipping_method_id' => $shippingMethodId,
                'min_price' => $item['min_price'],
            ])->first();

            if ($existingItem) {
                $existingItem->update($payload);
            } else {
                model('ShippingMethodItem')->create($payload);
            }
        }
    }
}