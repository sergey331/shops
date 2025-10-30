<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Book_category implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('book_category', function (Fields $field) {
            $field->id();
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('book_category');
    }
}