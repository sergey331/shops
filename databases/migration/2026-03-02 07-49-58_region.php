<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Region implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('regions', function (FieldsInterface $field) {
            $field->id();
            $field->string('name');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('regions');
    }
}