<?php

namespace Shop\controllers;

use Kernel\Controller\BaseController;
use Shop\service\Wishlist;

class WishListController extends BaseController
{
    private Wishlist $wishlist;

    public function __construct()
    {
        $this->wishlist = new Wishlist();
    }

    public function index(): void
    {
        $wishlists = $this->wishlist->list() ?? [];
        $this->response()->json([
            'count' => count($wishlists),
            'wishlistContent' => $this->view()->getHtml("Component.WishList.index", ['wishlists' => $wishlists])
        ]);
    }

    public function save(): void
    {
        $this->wishlist->save();
        $this->response()->json([
            'success' => true
        ]);
    }
}