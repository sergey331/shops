<?php

use Kernel\Route\Route;
use Shop\controllers\admin\AdminController;
use Shop\controllers\HomeController;
use Shop\controllers\AuthController;
use Shop\controllers\RegisterController;

return [
    Route::group(["middleware" => ["guest"]], function ($route) {
        return [
            $route->get('/register', [RegisterController::class, 'index']),
            $route->post('/register', [RegisterController::class, 'register']),
            $route->get('/login', [AuthController::class, 'index']),
            $route->post('/login', [AuthController::class, 'login']),
        
        ];
        
    }),
    Route::group(["middleware" => ["auth"]], function ($route) {
        return [
            $route->get('/logout', [AuthController::class, 'logout']),
        
        ]; 
    }),

    Route::group(["middleware" => ["admin"]], function ($route) {
        return [
            $route->get('/admin', [AdminController::class, 'index']),
        ]; 
    }),
    Route::get('/', [HomeController::class, 'index']),
    
];