<?php
namespace Shop\service;

use Kernel\Cart\Cart;
use Kernel\Cart\CartItem;
use Kernel\Cart\DbCartStorage;
use Kernel\Cart\SessionCartStorage;

class CartService
{
    public function save()
    {
        $book_id = request()->input('book_id');

        $cartStorage = auth()->check() ? new DbCartStorage() : new SessionCartStorage();

        $cart = new Cart($cartStorage);
        $cart->add($book_id, 1);

        return $cart;
    }
    public function update()
    {
        $book_id = request()->input('book_id');
        $qty = request()->input('qty');
        $cartStorage = auth()->check() ? new DbCartStorage() : new SessionCartStorage();

        $cart = new Cart($cartStorage);
        $cart->update($book_id, $qty);

        return $cart;
    }

    public function remove()
    {
        $book_id = request()->input('book_id');
        $cartStorage = auth()->check() ? new DbCartStorage() : new SessionCartStorage();

        $cart = new Cart($cartStorage);
        $cart->remove($book_id);

        return $cart;
    }
}