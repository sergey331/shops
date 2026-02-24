<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class WishList implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('wishlists',function (FieldsInterface $field) {
            $field->id();
            $field->relations('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('wishlists');
    }
}