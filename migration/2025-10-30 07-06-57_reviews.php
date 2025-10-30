<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Reviews implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('reviews', function (Fields $field) {
            $field->id();
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $field->string('user_name');
            $field->integer('rating')->default(0);
            $field->text('comment')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('reviews');
    }
}