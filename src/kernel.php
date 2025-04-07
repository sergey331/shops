<?php

use Shop\middleware\AuthMiddleware;

return [
    'middlewares' => [
        'auth' => AuthMiddleware::class
    ]
];