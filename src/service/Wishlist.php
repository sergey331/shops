<?php

namespace Shop\service;

use Kernel\Service\BaseService;

class Wishlist extends BaseService
{
    public function list()
    {
        return auth()->user()->with(['wishLists'])->wishLists;
    }

    public function getByBookId($book_id)
    {
        return auth()->user()->with(['wishLists'])->wishLists()->where(['book_id' => $book_id])->get();
    }

    public function save(): void
    {
        $data = [
            'user_id' => auth()->id(),
            'book_id' => request()->input('book_id')
        ];

        $wishlist = model('WishList')
            ->where($data)
            ->first();
        if ($wishlist) {
            $wishlist->delete();
        } else {
            model('WishList')->create($data);
        }
    }
}