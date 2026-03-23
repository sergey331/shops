<?php

namespace Kernel\Console\Commands;

class SeederMakeCommand extends MakeCommand
{
    public function __construct($name)
    {
        parent::__construct($name,'seed');
    }

    public function make(): void
    {
        $filename = __DIR__ . "/../../../databases/seeders/$this->name.php";
        if ($this->makeFile($filename)) {
            echo "Seeder created successfully: $filename" . PHP_EOL;
        } else {
            echo "Failed to write seeder file!" . PHP_EOL;
            exit(1);
        }
    }
}