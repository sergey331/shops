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
        $arg1 = $_SERVER['argv'][2] ?? '';
        $arg2 = $_SERVER['argv'][3] ?? '';
        $this->command->setCommand($command);
        if (!empty($arg1)) {
            $this->command->setArg1($arg1);
        }

        if (!empty($arg2)) {
            $this->command->setArg2($arg2);
        }
        $this->command->run();
    }
}