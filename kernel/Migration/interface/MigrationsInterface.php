<?php

namespace Kernel\Migration\interface;

use Kernel\Migration\Table;

interface MigrationsInterface
{
    public static function up(Table $table): void;

    public static function down(Table $table): void;
}