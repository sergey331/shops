<?php 
namespace Kernel\Cookie;

use Kernel\Cookie\interface\CookieInterface;

class Cookie implements CookieInterface
{
    public function set($name, $value, $expire = 3600, $path = "/", $domain = "", $secure = false, $httponly = true): void
    {
        setcookie($name, $value, time() + $expire, $path, $domain, $secure, $httponly);
    }

    public function get($name)
    {
        return $_COOKIE[$name] ?? null;
    }

    public function has($name): bool
    {
        return isset($_COOKIE[$name]);
    }

    public function remove($name): void
    {
        setcookie($name, '', time() - 3600);
        unset($_COOKIE[$name]);
    }

    public function all(): array
    {
        return $_COOKIE;
    }
}   