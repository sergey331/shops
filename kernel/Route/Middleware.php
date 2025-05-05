<?php

namespace Kernel\Route;

use Kernel\Container\Container;

class Middleware
{
    private Container $container;
    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function auth() 
    {
        return $this->container->get("auth");
    }

    public function redirect() 
    {
        return $this->container->get("redirect");
    }
}