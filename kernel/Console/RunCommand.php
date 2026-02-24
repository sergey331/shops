<?php

namespace Kernel\Console;

use Exception;
use Kernel\Console\interface\RunCommandInterface;
use Kernel\Migration\Migration;
use Kernel\Seeder\RunSeed;

class RunCommand implements RunCommandInterface
{
    private string $arg1 = '';
    private string $arg2 = '';
    private string $command = '';

    /**
     * Command registry: command => handler class or callback
     */
    private array $commandMap = [
        'make:migration' => [self::class, 'handleMake'],
        'migrate'        => [self::class, 'handleMigrate'],
        'migrate:reset'  => [self::class, 'handleMigrateReset'],
        'migrate:rollback' => [self::class, 'handleMigrateRollback'],
        'make:seed'      => [self::class, 'handleMakeSeed'],
        'seed'           => [self::class, 'handleSeed'],
        'make:controller'=> [self::class, 'handleMake'],
        'make:model'     => [self::class, 'handleMake'],
        'make:service'   => [self::class, 'handleMake'],
        'make:rule'   => [self::class, 'handleMake'],
    ];

    /**
     * Entry point.
     */
    public function run(): void
    {
        [$type, $arg] = array_pad($this->getResolvedCommandParts(), 2, null);

        $handler = $this->resolveHandler($this->command);

        if (!is_callable($handler)) {
            throw new Exception("Handler for command '{$this->command}' not found");
        }

        call_user_func($handler, $arg);
    }

    /**
     * Sets the command.
     * @throws Exception
     */
    public function setCommand(string $command): void
    {
        if (!$this->isValidCommand($command)) {
            throw new Exception("Command '$command' is not recognized");
        }
        $this->command = $command;
    }

    /**
     * Sets optional argument.
     */
    public function setArg1(string $arg1): void
    {
        $this->arg1 = $arg1;
    }

    public function setArg2(string $arg2): void
    {
        $this->arg2 = $arg2;
    }

    /**
     * Splits "command:sub" structure.
     */
    private function getResolvedCommandParts(): array
    {
        return explode(':', $this->command);
    }

    /**
     * Verifies if command exists.
     */
    private function isValidCommand(string $command): bool
    {
        return isset($this->commandMap[$command]);
    }

    /**
     * Finds the callable handler for a command.
     */
    private function resolveHandler(string $command): ?callable
    {
        return $this->commandMap[$command] ?? null;
    }

    /* =====================
     *  HANDLER METHODS
     * ===================== */

    private function handleMake(?string $arg): void
    {
        if (empty($this->arg1)) {
            throw new Exception("Missing argument for make command");
        }

        $make = new Make($arg, $this->arg1,$this->arg2);
        $make->run();
    }

    private function handleSeed(): void
    {
        $seed = new RunSeed($this->arg1);
        $seed->seed();
    }

    private function handleMakeSeed(): void
    {
        $this->handleMake('seed');
    }

    private function handleMigrate(): void
    {
        (new Migration())->migrate();
    }

    private function handleMigrateReset(): void
    {
        (new Migration())->resetMigration($this->arg1);
    }

    private function handleMigrateRollback(): void
    {
        (new Migration())->rollbackMigration();
    }
}
