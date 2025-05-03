<?php

namespace Kernel\Redirect;

use JetBrains\PhpStorm\NoReturn;

class Redirect
{
    public function to($url): void
    {
        header("Location: $url");
        exit();
    }
    public function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: $referer");
        exit();
    }
}