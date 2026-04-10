<?php
namespace Kernel\Container\Interface;
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

