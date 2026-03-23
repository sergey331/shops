<?php

namespace Kernel\Console\Commands;

class ServiceMakeCommand extends MakeCommand
{
    public function __construct($name)
    {
        parent::__construct($name,'service');
    }

    public function make(): void
    {
        $filename = __DIR__ . "/../../../src/service/$this->name.php";
        if ($this->makeFile($filename)) {
            echo "Service created successfully: $filename" . PHP_EOL;
        } else {
            echo "Failed to write service file!" . PHP_EOL;
            exit(1);
        }
    }
}