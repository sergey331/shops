<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Reviews implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('reviews', function (FieldsInterface $field) {
            $field->id();
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $field->string('user_name');
            $field->integer('rating')->default(0);
            $field->text('comment')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('TableInterface');
    }
}