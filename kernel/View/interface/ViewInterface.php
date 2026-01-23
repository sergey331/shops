<?php

namespace Kernel\View\interface;

interface ViewInterface
{
    public function load($path, $data = [],$layout = 'app'): void;

    public function getHtml($path,$data);
}