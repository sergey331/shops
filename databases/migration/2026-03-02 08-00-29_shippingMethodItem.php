<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class ShippingMethodItem implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('shipping_method_items', function (FieldsInterface $field) {
            $field->id();
            $field->decimal('price');
            $field->decimal('min_price');
            $field->decimal('max_price')->nullable();
            $field->relations('shipping_method_id')->nullable()->references('id')->on('shipping_methods')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('shipping_method_items');
    }
}