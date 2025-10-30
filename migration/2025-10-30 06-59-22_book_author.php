<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Book_author implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('book_author', function (Fields $field) {
            $field->id();
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('author_id')->references('id')->on('authors')->onDelete('cascade')->onUpdate('cascade');
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('book_author');
    }
}