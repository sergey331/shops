<?php

namespace Kernel\Console\interface;

use Kernel\Console\Commands\ControllerMakeCommand;
use Kernel\Console\Commands\MigrationMakeCommand;
use Kernel\Console\Commands\ModelMakeCommand;
use Kernel\Console\Commands\SeederMakeCommand;

interface MakeInterface
{
    public function run();
}