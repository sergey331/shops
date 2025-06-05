<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Users implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('users', function (Fields $field) {
            $field->id();
            $field->string('username',50)->unique();
            $field->string('email', 100)->unique();
            $field->tinyint('is_admin')->default(0);
            $field->string('avatar')->nullable();
            $field->string('password');
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('users');
    }
}
