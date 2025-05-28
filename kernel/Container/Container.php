<?php

namespace Kernel\Container;


use Closure;
use Exception;


class Container
{
    private array $services = [];
    private array $shared = [];

    // Register a service, with an optional shared flag
    public function set($name, $service, $shared = false): void
    {
        $this->services[$name] = $service;
        if ($shared) {
            $this->shared[$name] = $name;
        }
    }

    /**
     * @throws Exception
     */
    public function get($name)
    {
        // Check if it's a shared service and return the same instance
        if (isset($this->shared[$name])) {
            return $this->services[$name];
        }

        if (isset($this->services[$name])) {
            if ($this->services[$name] instanceof Closure) {
                return $this->services[$name]($this);
            }
            return $this->services[$name];
        }
        throw new Exception("Service not found: {$name}");
    }
}

