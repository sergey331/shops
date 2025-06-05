<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Products implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('products', function (Fields $field) {
            $field->id();
            $field->string('name', 100);
            $field->string('sku', 100);
            $field->decimal('price');
            $field->decimal('sale_price');
            $field->text('description')->nullable();
            $field->string('image_url')->nullable();
            $field->integer('stock')->default(0);
            $field->integer('quantity');
            $field->enum('status',['active', 'inactive', 'draft'])->default('active');
            $field->tinyint('featured')->default(0);
            $field->relations('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        // Your rollback logic here
    }
}
