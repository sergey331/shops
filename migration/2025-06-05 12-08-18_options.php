<?php

namespace Migration;

use Kernel\Migration\Fields;
use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class Options implements MigrationsInterface
{
    public static function up(Table $table): void
    {
        $table->createTable('options', function (Fields $field) {
            $field->id();
            $field->string('variant_name', 100)->unique();
            $field->string('value', 255);
            $field->decimal('price')->nullable();
            $field->createdTimestamp();
        });
    }

    public static function down(Table $table): void
    {
        $table->dropTable('options');
    }
}
