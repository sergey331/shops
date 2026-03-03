<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class GeoZone implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->createTable('geo_zones', function (FieldsInterface $field) {
            $field->id();
            $field->relations('region_id')->nullable()->references('id')->on('regions')->onDelete('cascade')->onUpdate('cascade');
            $field->relations('shipping_method_id')->nullable()->references('id')->on('shipping_methods')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->dropTable('geo_zones');
    }
}