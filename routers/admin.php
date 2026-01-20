<?php

use Kernel\Route\Route;
use Shop\controllers\admin\AboutController as AdminAboutController;
use Shop\controllers\admin\AdminController;
use Shop\controllers\admin\CategoryController;
use Shop\controllers\admin\PostController;
use Shop\controllers\admin\SlidersController;
use Shop\controllers\admin\BookController;

Route::prefix("/admin")->group(function () {
    Route::get('/', [AdminController::class, 'index']);

    Route::group(['prefix' => '/sliders'], function () {
        Route::get('/', [SlidersController::class, 'index']);
        Route::get('/create', [SlidersController::class, 'create']);
        Route::post('/store', [SlidersController::class, 'store']);
        Route::get('/{Slider}', [SlidersController::class, 'edit']);
        Route::post('/{Slider}', [SlidersController::class, 'update']);
        Route::get('/delete/{Slider}', [SlidersController::class, 'delete']);
    });

    Route::group(['prefix' => '/about'], function () {
        Route::get('/', [AdminAboutController::class, 'index']);
        Route::post('/modify', [AdminAboutController::class, 'modify']);
    });

    Route::group(['prefix' => '/posts'], function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/create', [PostController::class, 'create']);
        Route::post('/store', [PostController::class, 'store']);
        Route::get('/{Post}', [PostController::class, 'edit']);
        Route::post('/{Post}', [PostController::class, 'update']);
        Route::get('/delete/{Post}', [PostController::class, 'delete']);
    });

    Route::group(['prefix' => '/categories'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/create', [CategoryController::class, 'create']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::get('/{Category}', [CategoryController::class, 'edit']);
        Route::post('/{Category}', [CategoryController::class, 'update']);
        Route::get('/delete/{Category}', [CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => '/books'], function () {
        Route::get('/',[BookController::class,'index']);
        Route::get('/create',[BookController::class,'create']);
        Route::post('/store', [BookController::class,'store']);
        Route::get('/{book}', [BookController::class,'edit']);
        Route::get('/show/{book}', [BookController::class,'show']);
        Route::delete('/image/delete/{bookImage}',[BookController::class,'deleteImages']);
        Route::post('/image/store',[BookController::class,'imageStore']);
        Route::post('/discount/{book}',[BookController::class,'discount']);
    });
});