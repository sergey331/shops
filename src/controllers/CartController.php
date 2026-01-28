<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Shop\service\CartService;

class CartController extends BaseController
{
    private CartService $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Cart.Index', [
            'title' => 'Cart',
            'cartContent' => $this->view()->getHtml('Component.Cart.CartContent',[])
        ]);

    }

    public function add()
    {
        if ($cart = $this->cartService->save()) {
            $this->response()->json([
                'success' => true,
                'quantity' => count($cart->get()),
                'cartHtml' => $this->view()->getHtml('Component.Cart.Index', [
                    'cart' => $cart
                ])
            ]);
        }
    }

    public function update()
    {
        if ($cart = $this->cartService->update()) {
            $this->response()->json([
                'success' => true,
                'quantity' => count($cart->get()),
                'cartContent' => $this->view()->getHtml('Component.Cart.CartContent', [])
            ]);
        }
    }

    public function remove()
    {
        if ($cart = $this->cartService->remove()) {
            $this->response()->json([
                'success' => true,
                'quantity' => count($cart->get()),
                'cartContent' => $this->view()->getHtml('Component.Cart.CartContent', [])
            ]);
        }
    }
}