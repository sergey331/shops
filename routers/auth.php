<?php

use Kernel\Route\Route;
use Shop\controllers\AuthController;

    Route::get('/logout', [AuthController::class, 'logout']);