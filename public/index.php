<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("APP_PATH",dirname(__DIR__));

require APP_PATH . '/vendor/autoload.php';
require APP_PATH . '/config/env.php';
require APP_PATH . '/kernel/App.php';
