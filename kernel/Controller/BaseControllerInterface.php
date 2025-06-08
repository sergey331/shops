<?php

namespace Kernel\Controller;

use Kernel\Auth\AuthInterface;
use Kernel\Container\Container;
use Kernel\Redirect\RedirectInterface;
use Kernel\Request\RequestInterface;
use Kernel\Session\SessionInterface;
use Kernel\View\ViewInterface;

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
