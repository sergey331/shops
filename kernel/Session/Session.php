<?php

namespace Kernel\Session;

class Session implements SessionInterface
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }
    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }
    public function has($key): bool
    {
        return isset($_SESSION[$key]);
    }
    public function remove($key): void
    {
        unset($_SESSION[$key]);
    }
    public function all(): array
    {
        return $_SESSION;
    }
    public function getCLean($key)
    {
        $session = $_SESSION[$key] ?? null;
        unset($_SESSION[$key]);
        return $session;
    }
}