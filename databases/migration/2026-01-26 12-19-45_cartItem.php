<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class CartItem implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('cart_items', function (FieldsInterface $field) {
            $field->id();
            $field->relations('cart_id')->references('id')->on('carts')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $field->int('quantity');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('cart_items');
    }
}