<?php

use Kernel\Route\Route;
use Shop\controllers\AboutController;
use Shop\controllers\BlogController;
use Shop\controllers\CartController;
use Shop\controllers\CheckoutController;
use Shop\controllers\ContactController;
use Shop\controllers\HomeController;
use Shop\controllers\BookController as FrontBookController;
use Shop\controllers\ShopController;
use Shop\controllers\WishListController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/shop/filter', [ShopController::class, 'filter']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{Post}', [BlogController::class, 'show']);
Route::post('/blog/comment/{Post}', [BlogController::class, 'comment']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/book/{book}', [FrontBookController::class, 'index']);

Route::prefix('/cart')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/add',[CartController::class,'add']);
    Route::post('/update',[CartController::class,'update']);
    Route::post('/edit',[CartController::class,'edit']);
    Route::post('/remove',[CartController::class,'remove']);
});
Route::get('/checkout', [CheckoutController::class, 'index']);

Route::prefix('/wishlist')->group(function () {
    Route::get('/', [WishListController::class,'index']);
    Route::get('/get', [WishListController::class,'get']);
    Route::post('/save', [WishListController::class,'save']);
    Route::post('/remove', [WishListController::class,'remove']);
});