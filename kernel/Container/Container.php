<?php

namespace Kernel\Container;


use Closure;
use Exception;
use Kernel\Container\Interface\ContainerInterface;


class Container implements ContainerInterface
{
    private array $services = [];

    public static Container $application;

    public function __construct()
    {
        self::$application = $this;
    }
    // Register a service, with an optional shared flag
    public function set($name, $service): void
    {
        $this->services[$name] = $service;
    }

    /**
     * @throws Exception
     */
    public function get($name)
    {

        if (isset($this->services[$name])) {
            if ($this->services[$name] instanceof Closure) {
                return $this->services[$name]($this);
            }
            return $this->services[$name];
        }
        throw new Exception("Service not found: {$name}");
    }
}

