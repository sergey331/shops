<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Tag implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('tags', function (FieldsInterface $field) {
            $field->id();
            $field->string('name');
            $field->text('slug');
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('tags');
    }
}