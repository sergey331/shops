<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Tag implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('tags', function (Fields $field) {
            $field->id();
            $field->string('name');
            $field->text('slug');
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('tags');
    }
}