<?php

namespace Kernel\Config\inteface;

interface ConfigInterface
{
    public function get($key,$default);
}