<?php

namespace Kernel\Session;

interface SessionInterface
{
    public function set($key, $value): void;

    public function get($key);

    public function has($key): bool;

    public function remove($key): void;

    public function all(): array;

    public function getClean($key);
}
