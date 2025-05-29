<?php

use Kernel\App\App;
use Kernel\Auth\Auth;
use Kernel\Container\Container;
use Kernel\Databases\Db;
use Kernel\Redirect\Redirect;
use Kernel\Request\Request;
use Kernel\Route\ResolveRouter;
use Kernel\Route\RouteAction;
use Kernel\Route\Routers;
use Kernel\Session\Session;
use Kernel\View\View;

$container = new Container();

// Core services
$container->set('request', fn() => new Request($_GET, $_POST, $_FILES, $_SERVER));
$container->set('session', fn() => new Session());
$container->set('redirect', fn() => new Redirect());
$container->set('db', fn() => new Db());

// Services that need the container
$container->set('auth', fn() => new Auth($container));
$container->set('views', fn() => new View($container));
$container->set('routeAction', fn() => new RouteAction($container));
$container->set('router', fn() => new Routers($container));

// Run the application
$app = new App($container);

$app->setRouter(APP_PATH . '/config/router.php');

try {
    $app->run();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
