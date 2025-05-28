<?php

use Shop\middleware\AuthMiddleware;
use Shop\middleware\AdminMiddleware;
use Shop\middleware\GuestMiddleware;

return [
    'middlewares' => [
        'auth' => AuthMiddleware::class,
        'guest' => GuestMiddleware::class,
        'admin' => AdminMiddleware::class,
    ]
];