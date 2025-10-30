<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Book_images implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('book_images', function (Fields $field) {
            $field->id();
            $field->string('image_path');
            $field->integer('is_primary')->default(0);
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('book_images');
    }
}