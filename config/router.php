<?php

use Kernel\Route\Route;


Route::group(["middleware" => ["guest"]], function () {
    require __DIR__ . "/../routers/guest.php";
});
Route::group(["middleware" => ["auth"]], function () {
    require __DIR__ . "/../routers/auth.php";
});

Route::middleware(["admin"])->group(function () {
    require __DIR__ . "/../routers/admin.php";
});
require __DIR__ . "/../routers/client.php";
