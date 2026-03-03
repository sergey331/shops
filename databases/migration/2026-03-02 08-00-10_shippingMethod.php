<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class ShippingMethod implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('shipping_methods', function (FieldsInterface $field) {
            $field->id();
            $field->string('code')->unique();
            $field->string('name');
            $field->string('icon')->nullable();
            $field->boolean('enabled')->default(1);
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('shipping_methods');
    }
}