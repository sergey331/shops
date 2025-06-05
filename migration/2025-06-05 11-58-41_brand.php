<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Brand implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('brands', function (Fields $field) {;
            $field->id();
            $field->string('name', 100)->unique();
            $field->string('image_url')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('brands');
    }
}
