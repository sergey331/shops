<?php

use Kernel\Route\Route;
use Shop\controllers\admin\AdminController;
use Shop\controllers\AuthController;
use Shop\controllers\HomeController;
use Shop\controllers\RegisterController;
use Shop\controllers\admin\SlidersController;
use Shop\controllers\ShopController;
use Shop\controllers\admin\AboutController as AdminAboutController;
use Shop\controllers\AboutController;
use Shop\controllers\BlogController;
use Shop\controllers\ContactController;
use Shop\controllers\CartController;
use Shop\controllers\CheckoutController;
use Shop\controllers\ProductController as FrontProductController;
use Shop\controllers\admin\PostController;


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
    });
});
Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{Post}', [BlogController::class, 'show']);
Route::post('/blog/comment/{Post}', [BlogController::class, 'comment']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/product', [FrontProductController::class, 'index']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);
