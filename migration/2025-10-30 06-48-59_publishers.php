<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Publishers implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('publishers', function (Fields $field) {
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

    public static function down(Table $table): void
    {
        $table->dropTable('publishers');
    }
}