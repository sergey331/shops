<?php

use Kernel\Route\Route;
use Shop\controllers\HomeController;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/show/{id}', [HomeController::class, 'show']),

    Route::group(['middleware' => 'auth'], function ($router) {
        return [
            $router::get('/dashboard', [HomeController::class, 'index']),
            $router::get('/settings', [HomeController::class, 'show']),
        ];
    }),
];