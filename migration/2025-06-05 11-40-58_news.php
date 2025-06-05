<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class News implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('news', function (Fields $field) {
            $field->id();
            $field->string('title');
            $field->string('slug');
            $field->text('content');
            $field->string('image_url')->nullable();
            $field->datetime('published_at');
            $field->boolean('is_published')->default(0);
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('news');
    }
}
