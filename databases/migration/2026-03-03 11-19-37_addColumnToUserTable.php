<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class AddColumnToUserTable implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->updateAlterTable('users', function (FieldsInterface $field) {
            $field->string('first_name')->default('');
            $field->string('last_name')->default('');
            $field->int('address_id')->nullable();
            $field->string('phone')->nullable();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->updateAlterTable('users', function (FieldsInterface $field) {
            $field->dropColumn('first_name');
            $field->dropColumn('last_name');
            $field->dropColumn('address_id');
            $field->dropColumn('phone');
        });
    }
}