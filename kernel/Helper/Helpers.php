<?php

use Kernel\Container\Container;

function container(): Container
{
    return Container::$application;
}

function request()
{
    return container()->get('request');
}

function session()
{
    return container()->get('session');
}

function auth()
{
    return container()->get('auth');
}

function model($name)
{
    return container()->get('db')->model($name);
}
