<?php

namespace Kernel\View\interface;

interface ViewInterface
{
    public function load($path, $data = []): void;
}