<?php

namespace Kernel\Console\Commands;

class RuleMakeCommand extends MakeCommand
{
    public function __construct($name)
    {
        parent::__construct($name,'rule');
    }

    public function make(): void
    {
        $filename = __DIR__ . "/../../../src/rules/$this->name.php";
        if ($this->makeFile($filename)) {
            echo "Rule created successfully: $filename" . PHP_EOL;
        } else {
            echo "Failed to write rule file!" . PHP_EOL;
            exit(1);
        }
    }
}