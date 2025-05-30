<?php

namespace Kernel\Controller;

use Exception;
use Kernel\Auth\AuthInterface;
use Kernel\Container\Container;
use Kernel\Databases\DbInterface;
use Kernel\Redirect\RedirectInterface;
use Kernel\Request\RequestInterface;
use Kernel\Session\SessionInterface;
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

    protected function session(): SessionInterface
    {
        return $this->container->get('session');
    }


    protected function redirect(): RedirectInterface
    {
        return $this->container->get('redirect');
    }

    /**
     * @throws Exception
     */
    public function view(): ViewInterface
    {
        return $this->container->get('views');
    }

    public function auth(): AuthInterface
    {
        return $this->container->get('auth');
    }

    public function model($name): DbInterface
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