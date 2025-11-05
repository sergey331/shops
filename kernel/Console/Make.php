<?php

namespace Kernel\Console;

use Kernel\Controller\ControllerMakeCommand;
use Kernel\Migration\MigrationMakeCommand;
use Kernel\Model\ModelMakeCommand;
use Kernel\Seeder\SeederMakeCommand;

class Make
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