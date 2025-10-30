<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Authors implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('authors', function (Fields $field) {
            $field->id();
            $field->string('name');
            $field->string('slug')->unique();
            $field->text('bio')->nullable();
            $field->text('photo')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('authors');
    }
}