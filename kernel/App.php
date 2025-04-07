<?php

use Kernel\Container\Container;
use Kernel\Databases\Db;
use Kernel\Request\Request;
use Kernel\Route\RouteAction;
use Kernel\Route\Routers;
use Kernel\App\App;
use Kernel\View\View;

$container = new Container();

$container->set('request', function () {
    return new Request($_GET, $_POST, $_FILES, $_SERVER);
});

$container->set('views', function () {
    return new View();
});

$container->set('db', function () {
    return new Db();
});

$container->set('routeAction', function ($container) {
    return new RouteAction($container);
});

$container->set('router', function ($container) {
    return new Routers($container);
});


$app = new App($container);

try {
    $app->run();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    die();
}
