<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Payment implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('payments', function (FieldsInterface $field) {
            $field->id();
            $field->string('code')->unique();
            $field->string('name');
            $field->text('description');
            $field->string('icon');
            $field->int('sort_order');
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        // Your rollback logic here
    }
}