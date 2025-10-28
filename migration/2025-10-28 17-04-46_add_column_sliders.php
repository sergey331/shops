<?php

namespace Migration;

use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Add_column_sliders implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->updateAlterTable('sliders', function ($field) {
            $field->relations('product_id')->nullable()->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public static function down(Table $table): void
    {
        $table->updateAlterTable('sliders', function ($field) {
            $field->dropRelation('sliders_ibfk_1');
            $field->dropColumn('product_id');
        });
    }
}