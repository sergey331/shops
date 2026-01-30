<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class DisacountTarget implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('discount_targets', function (FieldsInterface $field) {
            $field->id();

            $field->int('discount_id');
            $field->enum('target_type', ['book', 'category', 'author', 'all']);
            $field->relations('target_id')->nullable()->references('id')->on('discounts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('discount_targets');
    }
}