<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Users implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('users', function (FieldsInterface $field) {
            $field->id();
            $field->string('username',50)->unique();
            $field->string('email', 100)->unique();
            $field->tinyint('is_admin')->default(0);
            $field->string('avatar')->nullable();
            $field->string('password');
            $field->createdTimestamp();
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('users');
    }
}
