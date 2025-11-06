<?php

namespace Kernel\Controller\interface;

use Kernel\Auth\interface\AuthInterface;
use Kernel\Container\Container;
use Kernel\Redirect\interface\RedirectInterface;
use Kernel\Request\interface\RequestInterface;
use Kernel\Session\interface\SessionInterface;
use Kernel\View\interface\ViewInterface;

interface BaseControllerInterface
{
    /**
     * Inject the service container.
     */
    public function setContainer(Container $container): void;

    public function request(): RequestInterface;

    public function session(): SessionInterface;

    public function redirect(): RedirectInterface;

    public function view(): ViewInterface;

    public function auth(): AuthInterface;

    public function model(string $name);
}
