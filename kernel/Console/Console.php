<?php

namespace Kernel\Console;

use Exception;
use Kernel\Console\interface\ConsoleInterface;

class Console implements ConsoleInterface
{
    private RunCommand $command;
    public function __construct()
    {
        $this->command = new RunCommand();
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $command = $_SERVER['argv'][1] ?? '';
        $argument = $_SERVER['argv'][2] ?? '';
        $this->command->setCommand($command);
        if (!empty($argument)) {
            $this->command->setArgument($argument);
        }
        $this->command->run();
    }
}