<?php

namespace Kernel\Console\Commands;

class MigrationMakeCommand extends MakeCommand
{
    public function __construct($name)
    {
        parent::__construct($name,'migration');
    }

    public function make()
    {
        $timestamp = date('Y-m-d H-i-s');
        $filename = __DIR__ . "/../../../databases/migration/{$timestamp}_" . lcfirst($this->name) . ".php";
        if (!$this->makeFile($filename)) {
            echo "Failed to write migration file!" . PHP_EOL;
            exit(1);
        } else {
            echo "Migration created successfully: $filename" . PHP_EOL;
        }
    }
}