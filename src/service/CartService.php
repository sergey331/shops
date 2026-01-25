<?php
namespace Shop\service;

use Kernel\Cart\CartItem;

class CartService
{
    public function save()
    {
        $book_id = request()->input('book_id');
        $book = model('Book')->find($book_id);


        $cartItem = new CartItem((int)$book_id,1,(float)$book->price);

        cart()->add($cartItem);
        return true;
    }
}