<?php

namespace Kernel\Controller;

use Exception;
use Kernel\Container\Container;
use Kernel\Request\RequestInterface;
use Kernel\View\ViewInterface;

abstract class BaseController
{
    /**
     * @return RequestInterface
     */


    protected Container $container;

    /**
     * @throws Exception
     */
    public function request(): RequestInterface
    {
        return $this->container->get("request");
    }

    protected function session()
    {
        return $this->container->get('session');
    }


    protected function redirect()
    {
        return $this->container->get('redirect');
    }

    /**
     * @throws Exception
     */
    public function view()
    {
        return $this->container->get('views');
    }

    public function model($name)
    {
        return $this->container->get('db')->model($name);
    }

    /**
     * @param Container $container
     */

    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }

}