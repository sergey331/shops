<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Book_images implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('book_images', function (FieldsInterface $field) {
            $field->id();
            $field->string('image_path');
            $field->integer('is_primary')->default(0);
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('book_images');
    }
}