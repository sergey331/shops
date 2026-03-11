<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class OrderStatus implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('order_statuses', function (FieldsInterface $field) {
            $field->id();
            $field->string('name');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('order_statuses');
    }
}