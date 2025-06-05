<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Product_discounts implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('product_discounts', function (Fields $field) {
            $field->id();
            $field->relations('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $field->enum('discount_type', ['percentage', 'fixed']);
            $field->decimal('discount_value', 10, 2)->default(0.00);
            $field->dateTime('start_date')->nullable();
            $field->dateTime('end_date')->nullable();
            $field->tinyint('is_active')->default(1);
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('product_discounts');
    }
}
