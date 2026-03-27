<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Notification implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('notifications', function (FieldsInterface $field) {
            $field->id();
            $field->string('title');
            $field->text('message')->nullable();
            $field->string('type');
            $field->int('item_id')->nullable();
            $field->boolean('is_read')->default(0);
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('notifications');
        }
}