<?php

use Kernel\Route\Route;
use Shop\controllers\admin\AboutController as AdminAboutController;
use Shop\controllers\admin\AdminController;
use Shop\controllers\admin\CategoryController;
use Shop\controllers\admin\DiscountController;
use Shop\controllers\admin\GeoZoneController;
use Shop\controllers\admin\NotificationController;
use Shop\controllers\admin\OrderController;
use Shop\controllers\admin\PostController;
use Shop\controllers\admin\ShippingMethodController;
use Shop\controllers\admin\ShippingMethodItemsController;
use Shop\controllers\admin\SlidersController;
use Shop\controllers\admin\BookController;
use Shop\controllers\admin\SettingController;

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
        Route::post('/{book}', [BookController::class,'update']);
        Route::get('/show/{book}', [BookController::class,'show']);
        Route::delete('/image/delete/{bookImage}',[BookController::class,'deleteImages']);
        Route::post('/image/store',[BookController::class,'imageStore']);
        Route::post('/discount/{book}',[BookController::class,'discount']);
        Route::post('/delete/{book}',[BookController::class,'delete']);
    });

    Route::group(['prefix' => '/setting'], function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::get('/{setting}', [SettingController::class, 'edit']);
        Route::post('/edit/{setting}', [SettingController::class, 'save']);
    });

    Route::group(['prefix' => '/discounts'], function () {
        Route::get('/',[DiscountController::class,'index']);
        Route::get('/create',[DiscountController::class,'create']);
        Route::post('/store', [DiscountController::class,'store']);
        Route::post('/delete/{discount}',[DiscountController::class,'delete']);
        Route::get('/edit/{discount}',[DiscountController::class,'edit']);
        Route::post('/update/{discount}',[DiscountController::class,'update']);
    });

    Route::group(['prefix' => '/shipping-methods'], function () {
        Route::get('/', [ShippingMethodController::class, 'index']);
        Route::get('/create', [ShippingMethodController::class, 'create']);
        Route::post('/store', [ShippingMethodController::class, 'store']);
        Route::get('/{ShippingMethod}', [ShippingMethodController::class, 'edit']);
        Route::post('/{ShippingMethod}', [ShippingMethodController::class, 'update']);
        Route::get('/delete/{ShippingMethod}', [ShippingMethodController::class, 'delete']);

        Route::group(['prefix' => '/items'], function () {
            Route::get('/{ShippingMethod}', [ShippingMethodItemsController::class, 'index']);
            Route::get('/create/{ShippingMethod}', [ShippingMethodItemsController::class, 'create']);
            Route::post('/store', [ShippingMethodItemsController::class, 'store']);
            Route::get('/{ShippingMethod}/{ShippingMethodItem}', [ShippingMethodItemsController::class, 'edit']);
            Route::post('/{ShippingMethodItem}', [ShippingMethodItemsController::class, 'update']);
            Route::get('/delete/{ShippingMethod}/{ShippingMethodItem}', [ShippingMethodItemsController::class, 'delete']);
        });
    });

    Route::group(['prefix' => '/geo-zones'], function () {
        Route::get('/', [GeoZoneController::class, 'index']);
        Route::get('/create', [GeoZoneController::class, 'create']);
        Route::post('/store', [GeoZoneController::class, 'store']);
        Route::get('/{GeoZone}', [GeoZoneController::class, 'edit']);
        Route::post('/{GeoZone}', [GeoZoneController::class, 'update']);
        Route::get('/delete/{GeoZone}', [GeoZoneController::class, 'delete']);
    });

    Route::group(['prefix' => '/orders'], function () {
        Route::get('/',[OrderController::class,'index']);
        Route::get('/{Order}',[OrderController::class,'show']);
    });

    Route::group(['prefix' => '/notification'], function () {
        Route::get('/',[NotificationController::class,'index']);
        Route::get('/{Order}',[OrderController::class,'show']);
    });
});