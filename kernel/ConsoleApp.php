<?php

use Kernel\Config\Config;
use Kernel\Console\Console;
use Kernel\Container\Container;
use Kernel\Databases\DbModel;

$container = new Container();

$container->set('db', fn() => new DbModel());
$container->set('config', fn() => new Config());
$container->set('console', fn() => new Console());