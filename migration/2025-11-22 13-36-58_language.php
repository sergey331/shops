<?php

namespace Migration;

use Kernel\Migration\interface\TableInterface;
use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;

class Language implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('languages', function(FieldsInterface $field) {
            $field->id();
            $field->string('code');
            $field->string('name');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('languages');
    }
}