<?php

require __DIR__ . "/config/env.php";
require __DIR__ . "/vendor/autoload.php";
require  __DIR__ . "/kernel/Config/Config.php";

$command = $_SERVER['argv'][1] ?? null;
$files = __DIR__ . '/seeders';

$files = array_filter(
    scandir($files),
    fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'php'
);

$files = array_map(fn($f) => pathinfo($f, PATHINFO_FILENAME), $files);

$selectedClass = $argv[2] ?? null;
if ($selectedClass) {
    $files = array_filter($files, fn($f) => $f === $selectedClass);
}

foreach ($files as $file) {
    $className = "Seeder\\{$file}";
    if (!class_exists($className)) {
        echo "Class not found: {$className}" . PHP_EOL;
        continue;
    }
    if (!method_exists($className, 'run')) {
        echo "Method run() not found in {$className}" . PHP_EOL;
        continue;
    }
    echo "Running seeder: {$className}::run()" . PHP_EOL;
    $seeder = new $className();
    $seeder->run();
    echo "Seeder completed: {$file}" . PHP_EOL;

}