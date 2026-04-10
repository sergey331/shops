<?php

namespace Migration;

use Kernel\Migration\interface\FieldsInterface;
use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class ChangeReviewColumn implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        $table->updateAlterTable('reviews', function (FieldsInterface $field) {
            $field->dropColumn('user_name');
            $field->relations('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public static function down(TableInterface $table): void
    {
        $table->updateAlterTable('reviews', function (FieldsInterface $field) {
            $field->string('user_name');
            $field->dropRelation('reviews_ibfk_2');
            $field->dropColumn('user_id');
        });
    }
}