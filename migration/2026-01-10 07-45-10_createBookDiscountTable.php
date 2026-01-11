<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class CreateBookDiscountTable implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('book_discounts', function (FieldsInterface $field) {
            $field->relations('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $field->decimal('price');
            $field->datetime('started_at');
            $field->datetime('finished_at')->nullable();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('book_discounts');
    }
}