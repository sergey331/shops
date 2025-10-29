<?php

use Kernel\Config\Config;
use Kernel\Container\Container;
use Kernel\Databases\Db;

$container = new Container();

$container->set('db', fn() => new Db());
$container->set('config', fn() => new Config());