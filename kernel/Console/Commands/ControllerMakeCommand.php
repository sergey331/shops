<?php

namespace Kernel\Console\Commands;

class ControllerMakeCommand extends MakeCommand
{
    public function __construct($name)
    {
        parent::__construct($name,'controller');
    }

    public function make(): void
    {
        $filename = __DIR__ . "/../../../src/controllers/$this->name.php";
        if ($this->makeFile($filename)) {
            echo "Controller created successfully: $filename" . PHP_EOL;
        } else {
            echo "Failed to write controller file!" . PHP_EOL;
            exit(1);
        }
    }
}