#!/usr/bin/env php
<?php

use Kernel\Console\Console;
use Kernel\Container\Container;

require __DIR__ . "/config/env.php";
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . '/kernel/Helper/Helpers.php';
require __DIR__ . "/kernel/ConsoleApp.php";

/**
 * @var  Container $container
 * @var  Console $console
 * */

try {
    $console = $container->get('console');
    $console->run();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}