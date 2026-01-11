<?php

namespace Migration;

use Kernel\Migration\interface\TableInterface;
use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;

class DeleteBookDiscountField implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->updateAlterTable('books', function (FieldsInterface $field) {
            $field->dropColumn('discount_price');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->updateAlterTable('books', function (FieldsInterface $field) {
            $field->decimal('discount_price')->default(null);
        });
    }
}