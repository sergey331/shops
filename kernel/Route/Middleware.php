<?php

namespace Kernel\Route;

use Exception;
use Kernel\Container\Container;

class Middleware
{
    private Container $container;
    public function __construct(Container $container) {
        $this->container = $container;
    }

    /**
     * @throws Exception
     */
    public function auth()
    {
        return $this->container->get("auth");
    }

    /**
     * @throws Exception
     */
    public function redirect()
    {
        return $this->container->get("redirect");
    }
}