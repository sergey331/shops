<?php

namespace Kernel\Console;

use Kernel\Console\Commands\ControllerMakeCommand;
use Kernel\Console\Commands\MigrationMakeCommand;
use Kernel\Console\Commands\ModelMakeCommand;
use Kernel\Console\Commands\RuleMakeCommand;
use Kernel\Console\Commands\SeederMakeCommand;
use Kernel\Console\Commands\ServiceMakeCommand;
use Kernel\Console\interface\MakeInterface;

class Make implements MakeInterface
{
    public function __construct(
        protected string $type,
        protected string $arg1,
        protected string $arg2,
    ){
    }

    public function run(): void
    {
        $this->{$this->type}();
    }

    private function controller(): void
    {
        (new ControllerMakeCommand($this->arg1))->make();
    }
    
    private function seed(): void
    {
        (new SeederMakeCommand($this->arg1))->make();
    }

    private function migration(): void
    {
        (new MigrationMakeCommand($this->arg1))->make();
    }

    private function model(): void
    {
        (new ModelMakeCommand($this->arg1,$this->arg2))->make();
    }
    private function service(): void
    {
        (new ServiceMakeCommand($this->arg1))->make();
    }

    private function rule(): void
    {
        (new RuleMakeCommand($this->arg1))->make();
    }
}