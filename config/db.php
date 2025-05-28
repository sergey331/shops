<?php
    return [
        "driver" => env("DB_DRIVER"),
        'host' =>  env('DB_HOST','localhost'),
        'user' => env('DB_USERNAME','root'),
        'password' => env('DB_PASSWORD',''),
        'database' => env('DB_DATABASE',''),
        'port' => env('DB_PORT','3306'),
    ];