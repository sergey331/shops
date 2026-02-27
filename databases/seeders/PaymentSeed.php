<?php
namespace Seeder;
use Kernel\Seeder\Seeder;

class PaymentSeed extends Seeder
{
    public static function run(): void
    {
        $payments = [
            [
                'code' => 'card',
                'name' => 'Credit Card',
                'description' => 'Pay using Visa or MasterCard',
                'icon' => '💳',
                'sort_order' => 1
            ],
            [
                'code' => 'paypal',
                'name' => 'PayPal',
                'description' => 'Secure PayPal checkout',
                'icon' => '🅿️',
                'sort_order' => 2
            ],
            [
                'code' => 'bank',
                'name' => 'Bank Transfer',
                'description' => 'Direct bank payment',
                'icon' => '🏦',
                'sort_order' => 3
            ],
            [
                'code' => 'cod',
                'name' => 'Cash on Delivery',
                'description' => 'Pay when receiving order',
                'icon' => '💵',
                'sort_order' => 4
            ]
        ];

        foreach ($payments as $payment) {
            model('Payment')->create($payment);
        }
    }
}