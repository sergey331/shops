<?php

use Kernel\App\App;
use Kernel\Auth\Auth;
use Kernel\Config\Config;
use Kernel\Container\Container;
use Kernel\Databases\DbModel;
use Kernel\Redirect\Redirect;
use Kernel\Request\Request;
use Kernel\Response\Response;
use Kernel\Route\RouteAction;
use Kernel\Route\Routers;
use Kernel\Session\Session;
use Kernel\View\View;
use Kernel\Cookie\Cookie;

$container = new Container();

// Core services
$container->set('request', fn() => new Request($_GET, $_POST, $_FILES, $_SERVER));
$container->set('session', fn() => new Session());
$container->set('cookie', fn() => new Cookie());
$container->set('redirect', fn() => new Redirect());
$container->set('db', fn() => new DbModel());
$container->set('config', fn() => new Config());
$container->set('response', fn() => new Response());

// Services that need the container
$container->set('auth', fn() => new Auth());
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
