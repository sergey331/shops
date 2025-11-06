<?php

namespace Kernel\Config;

use Kernel\Config\inteface\ConfigInterface;

class Config implements ConfigInterface
{
    private string $configDirectory = __DIR__ . '/../../config/';
    public function get($key,$default)
    {
        [$file,$key] = explode('.',$key, 2);

        $config = include $this->configDirectory . $file . '.php';
        return $config[$key] ?? $default;
    }
}