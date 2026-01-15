<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Post implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('posts', function (FieldsInterface $field) {
            $field->id();
            $field->relations('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $field->string('title');
            $field->string('slug')->unique();
            $field->longText('excerpt');
            $field->longText('content');
            $field->string('image');
            $field->enum('status', ['draft', 'published', 'archived'])->default('published');
            $field->datetime('published_at')->nullable();
            $field->string('meta_title')->nullable();
            $field->string('meta_description')->nullable();
            $field->integer('views')->default(0);
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('posts');
    }
}