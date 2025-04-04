<?php

use Kernel\Route\Route;
use Shop\controllers\HomeController;

return [
  Route::get('/', [HomeController::class, 'index']),
  Route::get('/show/{id}', [HomeController::class, 'show']),
];