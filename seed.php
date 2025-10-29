<?php

use Kernel\Seeder\RunSeed;

require __DIR__ . "/config/env.php";
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . '/kernel/Helper/Helpers.php';
require __DIR__ . "/kernel/ConsoleApp.php";

$command = $_SERVER['argv'][1] ?? '';

$seed = new RunSeed($command);
$seed->seed();