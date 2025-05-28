<?php

use Kernel\Route\Route;
use Shop\controllers\admin\AdminController;
use Shop\controllers\admin\CategoryController;
use Shop\controllers\admin\NewsController;
use Shop\controllers\admin\OptionController;
use Shop\controllers\admin\ProductController;
use Shop\controllers\HomeController;
use Shop\controllers\AuthController;
use Shop\controllers\RegisterController;
use Shop\controllers\admin\BrandController;

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

    Route::group(["middleware" => ["admin"], 'prefix' => '/admin'], function ($route) {
        return [
            $route->get('/', [AdminController::class, 'index']),
            $route->group(['prefix' => '/categories'], function ($route) {
                return [
                    $route->get('/', [CategoryController::class, 'index']),
                    $route->get('/create', [CategoryController::class, 'create']),
                    $route->post('/store', [CategoryController::class, 'store']),
                    $route->get('/{Category}', [CategoryController::class, 'edit']),
                    $route->post('/{Category}', [CategoryController::class, 'update']),
                    $route->get('/delete/{Category}', [CategoryController::class, 'delete']),
                ];
            }),
            $route->group(['prefix' => '/products'], function ($route) {
                return [
                    $route->get('/', [ProductController::class, 'index']),
                    $route->get('/create', [ProductController::class, 'create']),
                    $route->post('/store', [ProductController::class, 'store']),
                    $route->get('/{Product}', [ProductController::class, 'edit']),
                    $route->post('/{Product}', [ProductController::class, 'update']),
                    $route->get('/delete/{Product}', [ProductController::class, 'delete']),
                ];
            }),

            $route->group(['prefix' => '/brand'], function ($route) {
                return [
                    $route->get('/', [BrandController::class, 'index']),
                    $route->get('/create', [BrandController::class, 'create']),
                    $route->post('/store', [BrandController::class, 'store']),
                    $route->get('/{brand}', [BrandController::class, 'edit']),
                    $route->post('/{brand}', [BrandController::class, 'update']),
                    $route->get('/delete/{brand}', [BrandController::class, 'delete']),
                ];
            }),

            $route->group(['prefix' => '/option'], function ($route) {
                return [
                    $route->get('/', [OptionController::class, 'index']),
                    $route->get('/create', [OptionController::class, 'create']),
                    $route->post('/store', [OptionController::class, 'store']),
                    $route->get('/{option}', [OptionController::class, 'edit']),
                    $route->post('/{option}', [OptionController::class, 'update']),
                    $route->get('/delete/{option}', [OptionController::class, 'delete']),
                ];
            }),

            $route->group(['prefix' => '/news'], function ($route) {
                return [
                    $route->get('/', [NewsController::class, 'index']),
                    $route->get('/create', [NewsController::class, 'create']),
                    $route->post('/store', [NewsController::class, 'store']),
                    $route->get('/{News}', [NewsController::class, 'edit']),
                    $route->post('/{News}', [NewsController::class, 'update']),
                    $route->get('/delete/{News}', [NewsController::class, 'delete']),
                ];
            }),

        ];
    }),
    Route::get('/', [HomeController::class, 'index']),
];