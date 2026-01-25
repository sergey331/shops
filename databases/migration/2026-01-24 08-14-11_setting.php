<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Setting implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('settings', function (FieldsInterface $field) {
            $field->id();
            $field->string('email');
            $field->string('phone');
            $field->string('address');
            $field->string('logo')->nullable();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('settings');
    }
}