<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class About implements MigrationsInterface
{

    public static function up(Table $table): void
    {
        $table->createTable('about', function (Fields $field) {
            $field->id();
            $field->mediumText('content');
            $field->string('media_path');
            $field->enum('media_type', ['image', 'video'])->default('image');
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('about');
    }
}