<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Post_tags implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('post_tags', function (FieldsInterface $field) {
            $field->id();
            $field->relations('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('post_tags');
    }
}