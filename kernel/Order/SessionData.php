<?php

namespace Kernel\Order;

use Exception;

class SessionData
{
    /**
     * @throws Exception
     */
    public static function get(): ?array
    {
        return session()->get('order', []);
    }

    /**
     * @throws Exception
     */
    public static function set(array $data): void
    {
        session()->set('order', $data);
    }

    /**
     * @throws Exception
     */
    public static function clear(): void
    {
        session()->remove('order');
        cart()->removeAll();
    }
}