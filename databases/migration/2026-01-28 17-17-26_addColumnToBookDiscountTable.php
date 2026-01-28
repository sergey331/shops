<?php

namespace Migration;

use Kernel\Migration\interface\TableInterface;
use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;

class AddColumnToBookDiscountTable implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
       $table->updateAlterTable('book_discounts', function (FieldsInterface $field) {
            $field->enum('type',['percentage','fixed']);
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->updateAlterTable('book_discounts', function (FieldsInterface $field) {
           $field->dropColumn('type');
        });
    }
}