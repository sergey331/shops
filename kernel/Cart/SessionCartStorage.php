<?php

namespace Kernel\Cart;

use Kernel\Cart\interface\CartStorageInterface;

class SessionCartStorage implements CartStorageInterface
{
    public function load(): array
    {
        $items = [];

        $cart = session()->get('cart') ?? [];

        foreach ($cart as $bookId => $row) {
            $items[$bookId] = new CartItem(
                (int)$bookId,
                (int)$row['qty']
            );
        }

        return $items;
    }

    public function save(array $items): void
    {
        $cart = [];

        foreach ($items as $item) {
            $cart[$item->getBookId()] = [
                'qty' => $item->getQty()
            ];
        }

        session()->set('cart', $cart);
    }
}
