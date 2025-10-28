<?php

use Kernel\Migration\Migration;
use Kernel\Migration\MigrationMakeComand;

require __DIR__ . "/config/env.php";

$command = $_SERVER['argv'][1] ?? null;


// Entry point
switch ($command) {
    case 'migrate':
        (new Migration())->migrate();
        break;
    case 'make':
        $name = $argv[2] ?? null;
        (new MigrationMakeComand($name))->make();
        break;
    case 'reset':
        $steps = $argv[2] ?? null;
        (new Migration())->resetMigration($steps);
        break;
    case 'rollback':
        (new Migration())->rollbackMigration();
        break;
    default:
        showUsageAndExit();
}

// ---- Utilities ----

function showUsageAndExit(): void
{
    echo "Usage: php migration.php [migrate|make|reset|rollback]" . PHP_EOL;
    exit(1);
}
