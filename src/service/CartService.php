<?php
namespace Shop\service;

use Kernel\Cart\Cart;

class CartService
{
    public function save()
    {
        $book_id = request()->input('book_id');
        $qty = request()->input('qty');

        cart()->add($book_id, $qty);

        return cart();
    }
    public function update(): Cart
    {
        $book_id = request()->input('book_id');
        $qty = request()->input('qty');
        cart()->update($book_id, $qty);
        return cart();
    }

    public function remove(): Cart
    {
        $book_id = request()->input('book_id');
        cart()->remove($book_id);
        return cart();
    }
}