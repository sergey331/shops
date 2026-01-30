<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Disacount implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('discounts', function (FieldsInterface $field) {
            $field->id();
            $field->string('name');
            $field->enum('type', ['percentage', 'fixed']);
            $field->decimal('value', 10, 2);
            $field->decimal('min_order_amount')->nullable();
            $field->date('started_at');
            $field->date('finished_at')->nullable();
            $field->boolean('is_active')->default(1);

        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('discounts');
    }
}