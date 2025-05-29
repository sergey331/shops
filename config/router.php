<?php

use Kernel\Route\Route;
use Shop\controllers\admin\AdminController;
use Shop\controllers\admin\BrandController;
use Shop\controllers\admin\CategoryController;
use Shop\controllers\admin\NewsController;
use Shop\controllers\admin\OptionController;
use Shop\controllers\admin\ProductController;
use Shop\controllers\AuthController;
use Shop\controllers\HomeController;
use Shop\controllers\RegisterController;


Route::group(["middleware" => ["guest"]], function () {
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
});
Route::group(["middleware" => ["auth"]], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware(["admin"])->group(function () {
    Route::prefix("/admin")->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::group(['prefix' => '/categories'], function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/create', [CategoryController::class, 'create']);
            Route::post('/store', [CategoryController::class, 'store']);
            Route::get('/{Category}', [CategoryController::class, 'edit']);
            Route::post('/{Category}', [CategoryController::class, 'update']);
            Route::get('/delete/{Category}', [CategoryController::class, 'delete']);
        });
        Route::group(['prefix' => '/products'], function () {
            Route::get('/', [ProductController::class, 'index']);
            Route::get('/create', [ProductController::class, 'create']);
            Route::post('/store', [ProductController::class, 'store']);
            Route::get('/{Product}', [ProductController::class, 'edit']);
            Route::post('/{Product}', [ProductController::class, 'update']);
            Route::get('/delete/{Product}', [ProductController::class, 'delete']);
        });

        Route::group(['prefix' => '/brand'], function () {
            Route::get('/', [BrandController::class, 'index']);
            Route::get('/create', [BrandController::class, 'create']);
            Route::post('/store', [BrandController::class, 'store']);
            Route::get('/{brand}', [BrandController::class, 'edit']);
            Route::post('/{brand}', [BrandController::class, 'update']);
            Route::get('/delete/{brand}', [BrandController::class, 'delete']);
        });

        Route::group(['prefix' => '/option'], function () {
            Route::get('/', [OptionController::class, 'index']);
            Route::get('/create', [OptionController::class, 'create']);
            Route::post('/store', [OptionController::class, 'store']);
            Route::get('/{option}', [OptionController::class, 'edit']);
            Route::post('/{option}', [OptionController::class, 'update']);
            Route::get('/delete/{option}', [OptionController::class, 'delete']);
        });

        Route::group(['prefix' => '/news'], function () {
            Route::get('/', [NewsController::class, 'index']);
            Route::get('/create', [NewsController::class, 'create']);
            Route::post('/store', [NewsController::class, 'store']);
            Route::get('/{News}', [NewsController::class, 'edit']);
            Route::post('/{News}', [NewsController::class, 'update']);
            Route::get('/delete/{News}', [NewsController::class, 'delete']);
        });
    });
});
Route::get('/', [HomeController::class, 'index']);
