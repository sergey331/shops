<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Category implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('categories', function (FieldsInterface $field) {
            $field->id();
            $field->string('name');
            $field->text('description');
            $field->string('logo')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('categories');
    }
}