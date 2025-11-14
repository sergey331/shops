<?php

namespace Kernel\Console;

use Kernel\Console\Commands\ControllerMakeCommand;
use Kernel\Console\Commands\MigrationMakeCommand;
use Kernel\Console\Commands\ModelMakeCommand;
use Kernel\Console\Commands\SeederMakeCommand;
use Kernel\Console\interface\MakeInterface;

class Make implements MakeInterface
{
    public function __construct(
        protected string $type,
        protected string $argument,
    ){
    }

    public function run()
    {
        $this->{$this->type}();
    }

    private function controller(): void
    {
        (new ControllerMakeCommand($this->argument))->make();
    }
    
    private function seed(): void
    {
        (new SeederMakeCommand($this->argument))->make();
    }

    private function migration(): void
    {
        (new MigrationMakeCommand($this->argument))->make();
    }

    private function model(): void
    {
        (new ModelMakeCommand($this->argument))->make();
    }

}