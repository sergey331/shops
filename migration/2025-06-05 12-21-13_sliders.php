<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Sliders implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('sliders', function (Fields $field) {
            $field->id();
            $field->string('title');
            $field->text('content');
            $field->string('image_url')->nullable();
            $field->boolean('is_show')->default(0);
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('sliders');
    }
}
