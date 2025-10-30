<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Books implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('books', function (Fields $field) {
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

    public static function down(Table $table): void
    {
        $table->dropTable('books');
    }
}