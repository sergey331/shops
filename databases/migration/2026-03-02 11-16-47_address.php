<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Address implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('address', function (FieldsInterface $field) {
            $field->id();
            $field->string('phone');
            $field->string('region_id');
            $field->string('city');
            $field->string('address');
            $field->string('address1')->nullable();
            $field->string('zip');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('address');
    }
}