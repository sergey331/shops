<?php

use Kernel\Route\Route;
use Shop\controllers\AuthController;
use Shop\controllers\ReviewController;

Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/reviews', [ReviewController::class, 'index']);