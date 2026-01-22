<?php

namespace Migration;

use Kernel\Migration\interface\TableInterface;
use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;

class AddCurrencyInBook implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
       $table->updateAlterTable('books', function (FieldsInterface $field) {
            $field->relations('currency_id')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public static function down(TableInterface $table): void
    {
       $table->updateAlterTable('books', function (FieldsInterface $field) {
            $field->dropRelation('books_ibfk_3');
            $field->dropColumn('currency_id');
        });
    }
}