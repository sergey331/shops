<?php

namespace Kernel\Console\interface;

use Exception;
use Kernel\Console\RunCommand;

interface ConsoleInterface
{
    public function __construct();

    /**
     * @throws Exception
     */
    public function run(): void;
}