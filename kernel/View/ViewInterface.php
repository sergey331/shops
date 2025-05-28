<?php

namespace Kernel\View;

interface ViewInterface
{
    public function load($path, $data = []): void;
}