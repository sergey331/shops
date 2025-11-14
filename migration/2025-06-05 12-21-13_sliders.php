<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Sliders implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('sliders', function (FieldsInterface $field) {
            $field->id();
            $field->string('title');
            $field->text('content');
            $field->string('image_url')->nullable();
            $field->boolean('is_show')->default(0);
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('sliders');
    }
}
