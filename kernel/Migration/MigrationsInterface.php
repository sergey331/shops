<?php

namespace Kernel\Migration;

interface MigrationsInterface
{
    public static function up(Table $table): void;

    public static function down(Table $table): void;
}