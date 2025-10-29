<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Category implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('categories', function (Fields $field) {
            $field->id();
            $field->string('name');
            $field->text('description');
            $field->string('logo')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('categories');
    }
}