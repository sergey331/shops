<?php

namespace Migration;

use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Categories implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('categories', function ($field) {
            $field->id();
            $field->string('name', 100)->unique();
            $field->relations('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $field->text('description')->nullable();
            $field->text('avatar')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('categories');
    }
}
