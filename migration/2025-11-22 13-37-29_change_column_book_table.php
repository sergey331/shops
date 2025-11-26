<?php

namespace Migration;

use Kernel\Migration\interface\TableInterface;
use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;

class Change_column_book_table implements MigrationsInterface
{
     public static function up(TableInterface $table): void
    {
        $table->updateAlterTable('books', function(FieldsInterface $field) {
            $field->dropColumn('language');
            $field->relations('language_id')->nullable()->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade')->after('isbn');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->updateAlterTable('books', function(FieldsInterface $field) {
            $field->dropRelation('books_ibfk_2');
            $field->dropColumn('language_id');
            $field->string('language')->default('English')->after('isbn');
        });
    }
}