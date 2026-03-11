<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class OrderBook implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('order_books', function (FieldsInterface $field) {
            $field->id();
            $field->int('book_id');
            $field->string('name');
            $field->decimal('price');
            $field->int('quantity');
            $field->relations('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('order_books');
    }
}