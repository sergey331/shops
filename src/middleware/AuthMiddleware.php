<?php

namespace Shop\middleware;

class AuthMiddleware
{
    public function handle($next)
    {
        return $next();
    }
}