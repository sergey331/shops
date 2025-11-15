<?php

use Kernel\Route\Route;
use Shop\controllers\AuthController;
use Shop\controllers\RegisterController;

    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);