<?php

namespace Kernel\Cart;

class Cart
{
    private array $cart;

    public function __construct()
    {
        if (!session()->has('cart')) {
            session()->set('cart', []);
        }

        $this->cart = session()->get('cart');
    }

    public function add(CartItem $cartItem): void
    {
        foreach ($this->cart as $item) {
            if ($item->getBookId() === $cartItem->getBookId()) {
                $item->increaseQuantity($cartItem->getQuantity());
                return;
            }
        }

        $this->cart[] = $cartItem;
    }

    public function update(CartItem $cartItem): void
    {
        foreach ($this->cart as $item) {
            if ($item->getBookId() === $cartItem->getBookId()) {
                $item->setQuantity($cartItem->getQuantity());
                return;
            }
        }
    }

    // Return cart with books loaded (single query)
    public function get(): array
    {

        foreach ($this->cart as $item) {
            $book = model('Book')->find($item->getBookId());
            $item->setBook($book ?? null);
        }

        return $this->cart;
    }

    // Total using stored price
    public function total(): float
    {
        $total = 0.0;
        foreach ($this->cart as $item) {
            $total += $item->getSubtotal(); // uses stored price
        }
        return $total;
    }

    public function remove(int $bookId): void
    {
        foreach ($this->cart as $key => $item) {
            if ($item->getBookId() === $bookId) {
                unset($this->cart[$key]);
                // Re-index numeric array if needed
                $this->cart = array_values($this->cart);
                return;
            }
        }
    }

    public function clear(): void
    {
        $this->cart = [];
    }

    public function __destruct()
    {
        session()->set('cart', $this->cart);
    }


}
