<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class AddColumnToSetting implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->updateAlterTable('settings', function (FieldsInterface $field) {
            $field->boolean('order_email')->default(0);
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->updateAlterTable('settings', function (FieldsInterface $field) {
            $field->dropColumn('order_email');
        });
    }
}