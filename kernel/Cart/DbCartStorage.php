<?php

namespace Kernel\Cart;

use Kernel\Cart\interface\CartStorageInterface;

class DbCartStorage implements CartStorageInterface
{
    private int $cartId;

    public function __construct()
    {
        $this->cartId = $this->resolveCartId();
    }

    private function resolveCartId(): int
    {
        $identity = auth()->check()
            ? ['user_id' => auth()->id()]
            : ['session_id' => session_id()];

        $cart = model('Cart')->where($identity)->first();

        if (!$cart) {
            $cart = model('Cart')->create($identity);
        }

        return (int) $cart->id;
    }

    public function load(): array
    {
        $items = [];

        $rows = model('CartItem')
            ->where(['cart_id' => $this->cartId])
            ->get();

        foreach ($rows as $row) {
            $items[$row->book_id] = new CartItem(
                (int)$row->book_id,
                (int)$row->quantity
            );
        }

        return $items;
    }

    public function save(array $items): void
    {
        model('CartItem')->where(['cart_id' => $this->cartId])->delete();

        foreach ($items as $item) {
            model('CartItem')->create([
                'cart_id'  => $this->cartId,
                'book_id'  => $item->getBookId(),
                'quantity' => $item->getQty()
            ]);
        }
    }
}
