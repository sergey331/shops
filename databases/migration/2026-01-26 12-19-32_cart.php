<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Cart implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('carts', function (FieldsInterface $field) {
            $field->id();
            $field->int('user_id')->nullable();
            $field->string('session_id')->nullable();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('cart');
    }
}