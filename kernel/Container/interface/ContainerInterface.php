<?php

namespace Kernel\Container\interface;


use Closure;
use Exception;


interface ContainerInterface
{
    public function __construct();

    public function set($name, $service): void;
    /**
     * @throws Exception
     */
    public function get($name);
}

