<?php

namespace Migration;

use Kernel\Migration\interface\TableInterface;
use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;

class AddUserField implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->updateAlterTable('users', function(FieldsInterface $field) {
            $field->string('remember_token')->nullable();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->updateAlterTable('users', function(FieldsInterface $field) {
            $field->dropColumn('remember_token');
        });
    }
}