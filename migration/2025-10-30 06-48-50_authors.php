<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Authors implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('authors', function (FieldsInterface $field) {
            $field->id();
            $field->string('name');
            $field->string('slug')->unique();
            $field->text('bio')->nullable();
            $field->text('photo')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('authors');
    }
}