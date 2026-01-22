<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class Currency implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('currencies', function (FieldsInterface $field) {
            $field->id();
            $field->string('name');
            $field->string('code', 3);
            $field->string('symbol', 5);
            $field->decimal('exchange_rate', 15, 8);
            $field->boolean('is_default')->default(0);
            $field->createdTimestamp();
        });        
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('currencies');  
    }
}