<?php

namespace Migration;

use Kernel\Migration\interface\MigrationsInterface;
use Kernel\Migration\interface\TableInterface;

class OrderStatus implements MigrationsInterface
{
    public static function up(TableInterface $table): void
    {
        // Your migration logic here
    }

    public static function down(TableInterface $table): void
    {
        // Your rollback logic here
    }
}