<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Publishers implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('publishers', function (FieldsInterface $field) {
            $field->id();
            $field->string('name');
            $field->string('slug')->unique();
            $field->text('website')->nullable();
            $field->text('email')->nullable();
            $field->text('phone')->nullable();
            $field->text('address')->nullable();
            $field->text('bio')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('publishers');
    }
}