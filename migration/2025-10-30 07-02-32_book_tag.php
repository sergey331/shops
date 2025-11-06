<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Book_tag implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('book_tag', function (FieldsInterface $field) {
            $field->id();
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('book_tag');
    }
}