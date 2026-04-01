<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Shop\service\OrderService;

class CheckoutController extends BaseController
{
    protected OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }

    public function index(): void
    {
        $step = session()->get('order');
        $this->view()->load('Checkout.Index', [
            'title' => 'Checkout',
            'step' => $step['step'] ?? ''
        ]);
    }

    /**
     * @throws Exception
     */
    public function loadProcess(): void
    {
        $this->response()->json(
            $this->orderService->loadProcess()
        );
    }


    /**
     * @throws Exception
     */
    public function processCheckout(): void
    {
        $this->response()->json(
            $this->orderService->processCheckout()
        );
    }
    /**
     * @throws Exception
     */
    public function clearOrder(): void
    {
        $this->orderService->clearOrder();
    }
}