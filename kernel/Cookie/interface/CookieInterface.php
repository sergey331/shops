<?php
namespace Kernel\Cookie\interface;

interface CookieInterface 
{

     public function set($name, $value, $expire = 3600, $path = "/", $domain = "", $secure = false, $httponly = true): void;

    public function get($name);

    public function has($name): bool;

    public function remove($name): void;

    public function all(): array;
    
}