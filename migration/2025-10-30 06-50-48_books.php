<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Books implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('books', function (FieldsInterface $field) {
            $field->id();
            $field->string('title');
            $field->string('slug')->unique();
            $field->text('description')->nullable();
            $field->string('isbn')->nullable();
            $field->string('language')->default('English');
            $field->integer('pages')->default(0);
            $field->decimal('price')->default(0.00);
            $field->decimal('discount_price')->default(null);
            $field->integer('stock')->default(0);
            $field->string('cover_image')->nullable();
            $field->relations('publisher_id')->references('id')->on('publishers')->onDelete('cascade')->onUpdate('cascade');
            $field->date('publication_date')->nullable();
            $field->decimal('rating')->default(0.00);
            $field->integer('featured')->default(0);
            $field->enum('status',['draft', 'published', 'archived'])->default('published');
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('books');
    }
}