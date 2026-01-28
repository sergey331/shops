<?php

namespace Kernel\Cart\interface;

use Kernel\Cart\CartItem;

interface CartStorageInterface
{
    /** @return CartItem[] */
    public function load(): array;

    /** @param CartItem[] $items */
    public function save(array $items): void;

    public function remove(int $bookId): void;
}