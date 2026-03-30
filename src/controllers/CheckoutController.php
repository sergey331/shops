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
    public function step1(): void
    {
        $this->response()->json(
            $this->orderService->step1()
        );
    }


    /**
     * @throws Exception
     */
    public function updateStep(): void
    {
        $this->response()->json(
            $this->orderService->updateStep()
        );
    }

    /**
     * @throws Exception
     */
    public function saveStep1(): void
    {
        $this->response()->json($this->orderService->saveStep1());
    }

    /**
     * @throws Exception
     */
    public function savePersonalInfo(): void
    {
        $this->response()->json($this->orderService->savePersonalInfo());
    }

    /**
     * @throws Exception
     */
    public function savePaymentMethod(): void
    {
        $this->response()->json($this->orderService->savePaymentMethod());
    }

    /**
     * @throws Exception
     */
    public function confirm(): void
    {
        $this->response()->json($this->orderService->confirm());
    }
    /**
     * @throws Exception
     */
    public function clearOrder(): void
    {
        $this->response()->json($this->orderService->clearOrder());
    }
}