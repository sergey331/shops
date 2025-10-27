<?php

use Kernel\Container\Container;
use Kernel\Redirect\Redirect;
use Kernel\Request\Request;
use Kernel\Session\Session;

function container(): Container
{
    return Container::$application;
}

/**
 * @return Request
 * @throws Exception
 */
function request(): Request
{
    return container()->get('request');
}

/**
 * @return Session
 * @throws Exception
 */
function session(): Session
{
    return container()->get('session');
}

/**
 * @return Redirect
 * @throws Exception
 */
function auth(): Redirect
{
    return container()->get('auth');
}

function model($name)
{
    return container()->get('db')->model($name);
}

function public_path($path): string
{
    return env('APP_URL') . '/' . $path;
}

function config($key,$default = null)
{
    return container()->get('config')->get($key,$default);
}
