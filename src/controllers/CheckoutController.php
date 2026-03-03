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
        $this->view()->load('Checkout.Index', [
            'title' => 'Checkout',
        ]);
    }

    public function step1()
    {
        $this->response()->html(
            $this->orderService->step1()
        );
    }

    public function saveStep1(): void
    {
        $this->response()->json($this->orderService->saveStep1());
    }

    public function savePersonalInfo(): void
    {
        $this->response()->json($this->orderService->savePersonalInfo());
    }
}