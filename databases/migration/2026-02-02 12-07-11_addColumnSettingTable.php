<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class AddColumnSettingTable implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->updateAlterTable('settings', function (FieldsInterface $field) {
            $field->int('default_discount_days')->nullable();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->updateAlterTable('settings', function (FieldsInterface $field) {
            $field->dropColumn('default_discount_days');
        });
    }
}