<?php

namespace Kernel\Console\Commands;

class ModelMakeCommand extends MakeCommand
{
    protected string $arg = '';

    public function __construct($name,$arg = '')
    {
        parent::__construct($name,'model');
        $this->arg = $arg;
    }

    public function make(): void
    {
        $filename = __DIR__ . "/../../../src/model/$this->name.php";
        if ($this->makeFile($filename, $this->content)) {
            echo "Model created successfully: $filename" . PHP_EOL;
            if (!empty($this->arg) && $this->arg === '-m') {
                (new MigrationMakeCommand($this->name))->make();
            }
        } else {
            echo "Failed to write model file!" . PHP_EOL;
            exit(1);
        }
    }
}