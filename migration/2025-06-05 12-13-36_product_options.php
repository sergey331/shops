<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Product_options implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('product_options', function (Fields $field) {
            $field->id();
            $field->relations('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('option_id')->references('id')->on('options')->onDelete('cascade')->onUpdate('cascade');
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('product_options');
    }
}
