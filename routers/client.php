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

Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/shop/filter', [ShopController::class, 'filter']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{Post}', [BlogController::class, 'show']);
Route::post('/blog/comment/{Post}', [BlogController::class, 'comment']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/book/{book}', [FrontBookController::class, 'index']);

Route::get('/cart', [CartController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/cart/add',[CartController::class,'add']);
Route::post('/cart/update',[CartController::class,'update']);
Route::post('/cart/edit',[CartController::class,'edit']);
Route::post('/cart/remove',[CartController::class,'remove']);