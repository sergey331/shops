<?php

namespace Seeder;

use Kernel\Seeder\Seeder;

class OrderStatusSeed extends Seeder
{
    public static function run(): void
    {

        $orderStatuses = [
            ['name' => 'Pending'],
            ['name' => 'Processing'],
            ['name' => 'On Hold'],
            ['name' => 'Confirmed'],
            ['name' => 'Shipped'],
            ['name' => 'Out for Delivery'],
            ['name' => 'Delivered'],
            ['name' => 'Completed'],
            ['name' => 'Cancelled'],
            ['name' => 'Refunded'],
            ['name' => 'Failed'],
        ];
        foreach ($orderStatuses as $orderStatus) {
            model('OrderStatus')->create($orderStatus);
        }
    }
}