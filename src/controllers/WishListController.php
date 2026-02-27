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

    public function index()
    {

        $this->view()->load('Wishlist.Index',[
            'title' => 'Wishlist',
            'wishlistContent' => $this->view()->getHtml("Component.Wishlist.Index", ['wishlists' => $this->wishlist->list()])
        ]);
    }
    public function get(): void
    {
        $wishlists = $this->wishlist->list() ?? [];
        $this->response()->json([
            'count' => count($wishlists),
            'wishlistContent' => $this->view()->getHtml("Component.Wishlist.Layout", ['wishlists' => $wishlists])
        ]);
    }

    public function save(): void
    {
        $this->wishlist->save();
        $this->response()->json([
            'success' => true
        ]);
    }
    public function remove(): void
    {
        $this->wishlist->remove();
      $this->redirect()->back();
    }
}