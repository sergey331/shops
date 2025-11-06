<?php

namespace Kernel\Console\interface;

use Exception;
use Kernel\Console\Make;
use Kernel\Migration\Migration;
use Kernel\Seeder\RunSeed;

interface RunCommandInterface
{

    /**
     * Entry point.
     */
    public function run(): void;

    /**
     * Sets the command.
     * @throws Exception
     */
    public function setCommand(string $command): void;

    /**
     * Sets optional argument.
     */
    public function setArgument(string $argument): void;
}
