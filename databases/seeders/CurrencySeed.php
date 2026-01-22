<?php

namespace Seeder;

use Shop\model\Currency;
use Kernel\Seeder\Seeder;

class CurrencySeed extends Seeder
{
    public static function run(): void
    {
        $currencies = [
            [
                'name' => 'US Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'exchange_rate' => 1.00000000,
                'is_default' => 1,
            ],
            [
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'exchange_rate' => 0.92000000,
                'is_default' => 0,
            ],
            [
                'name' => 'British Pound',
                'code' => 'GBP',
                'symbol' => '£',
                'exchange_rate' => 0.78000000,
                'is_default' => 0,
            ],
            [
                'name' => 'Armenian Dram',
                'code' => 'AMD',
                'symbol' => '֏',
                'exchange_rate' => 405.00000000,
                'is_default' => 0,
            ],
            [
                'name' => 'Russian Ruble',
                'code' => 'RUB',
                'symbol' => '₽',
                'exchange_rate' => 92.50000000,
                'is_default' => 0,
            ],
            [
                'name' => 'Ukrainian Hryvnia',
                'code' => 'UAH',
                'symbol' => '₴',
                'exchange_rate' => 38.20000000,
                'is_default' => 0,
            ],
            [
                'name' => 'Georgian Lari',
                'code' => 'GEL',
                'symbol' => '₾',
                'exchange_rate' => 2.68000000,
                'is_default' => 0,
            ],
            [
                'name' => 'Turkish Lira',
                'code' => 'TRY',
                'symbol' => '₺',
                'exchange_rate' => 30.50000000,
                'is_default' => 0,
            ],
        ];

        foreach ($currencies as $currency) {
           model('Currency')->create($currency);
        }
    }
}
