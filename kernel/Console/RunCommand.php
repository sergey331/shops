<?php

namespace Kernel\Console;

use Exception;
use Kernel\Migration\Migration;
use Kernel\Seeder\RunSeed;

class RunCommand
{
    private string $argument = '';
    private array $commandLists = [
        'make:migration',
        'migrate',
        'migrate:reset',
        'migrate:rollback',
        'make:seed',
        'seed',
        'make:controller',
        'make:model',
    ];
    protected string $command;

    public function run(): void
    {
        [$type, $arg] = array_pad((array)$this->getResolvedCommands(), 2, null);
        $this->{$type}($arg);
    }

    /**
     * @param string $argument
     */
    public function setArgument(string $argument): void
    {
        $this->argument = $argument;
    }

    /**
     * @throws Exception
     */
    public function setCommand(string $command): void
    {
        if (!$this->validCommand($command)) {
            throw new Exception("Command '$command' not resolved");
        }
        $this->command = $command;
    }

    private function getResolvedCommands(): array
    {
        return explode(':', $this->command);
    }

    /**
     * @throws Exception
     */
    private function make($arg)
    {
        if (empty($this->argument)) {
            throw new Exception("error accorded");
        }
        $make = new Make($arg, $this->argument);
        $make->run();
    }

    private function seed($arg): void
    {
        $seed = new RunSeed($this->argument);
        $seed->seed();
    }

    private function migrate($arg): void
    {
        switch ($arg) {
            case 'reset':
                (new Migration())->resetMigration($this->argument);
                break;
            case 'rollback':
                (new Migration())->rollbackMigration();
                break;
            default:
                (new Migration())->migrate();
                break;
        }
    }

    private function validCommand($command): bool
    {
        return in_array($command, $this->commandLists);
    }
}