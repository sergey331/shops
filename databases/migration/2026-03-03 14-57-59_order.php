<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Order implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('orders', function (FieldsInterface $field) {
            $field->id();
            $field->string('first_name');
            $field->string('last_name');
            $field->string('email');
            $field->int('address_id');
            $field->int('user_id')->nullable();
            $field->int('payment_id');
            $field->int('shipping_id');
            $field->int('shipping_item_id');
            $field->int('status_id');
            $field->int('subtotal');
            $field->int('discounted');
            $field->int('total');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('orders');
    }
}