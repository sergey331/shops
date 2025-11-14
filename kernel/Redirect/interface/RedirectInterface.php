<?php

namespace Kernel\Redirect\interface;

interface RedirectInterface
{
    public function to($url): void;
    public function back(): void;
}