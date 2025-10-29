<?php

use Kernel\Route\Route;
use Shop\controllers\admin\AdminController;
use Shop\controllers\AuthController;
use Shop\controllers\HomeController;
use Shop\controllers\RegisterController;
use Shop\controllers\admin\SlidersController;
use Shop\controllers\ShopController;
use Shop\controllers\AboutController;
use Shop\controllers\BlogController;
use Shop\controllers\ContactController;
use Shop\controllers\CartController;
use Shop\controllers\CheckoutController;
use Shop\controllers\ProductController as FrontProductController;


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
    });
});
Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'show']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/product', [FrontProductController::class, 'index']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);
