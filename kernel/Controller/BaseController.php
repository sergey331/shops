<?php

namespace Kernel\Controller;

use Exception;
use Kernel\Auth\interface\AuthInterface;
use Kernel\Container\Container;
use Kernel\Controller\interface\BaseControllerInterface;
use Kernel\Redirect\interface\RedirectInterface;
use Kernel\Request\interface\RequestInterface;
use Kernel\Response\interface\ResponseInterface;
use Kernel\Session\interface\SessionInterface;
use Kernel\View\interface\ViewInterface;

abstract class BaseController implements BaseControllerInterface
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

    public function response(): ResponseInterface
    {
        return $this->container->get('response');
    }

    public function session(): SessionInterface
    {
        return $this->container->get('session');
    }


    public function redirect(): RedirectInterface
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