<?php

namespace Kernel\Redirect;

interface RedirectInterface
{
    public function to($url): void;
    public function back(): void;
}