<?php

namespace Kernel\App\interface;

use Kernel\Container\Container;
use Exception;

interface AppInterface
{
    public function __construct(Container $container);

    public function setRouter($file): void;

    /**
     * @throws Exception
     */
    public function run(): void;
}
