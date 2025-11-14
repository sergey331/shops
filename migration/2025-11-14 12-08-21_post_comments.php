<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Post_comments implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('post_comments', function (FieldsInterface $field) {
            $field->id();
            $field->relations('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('postcomment_id')->nullable()->references('id')->on('post_comments')->onDelete('cascade')->onUpdate('cascade');
            $field->text('comment')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('post_comments');
    }
}