<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class About implements MigrationsInterface
{

    public static function up(TableInterface $table): void
    {
        $table->createTable('about', function (FieldsInterface $field) {
            $field->id();
            $field->mediumText('content');
            $field->string('media_path');
            $field->enum('media_type', ['image', 'video'])->default('image');
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('about');
    }
}