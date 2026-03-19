<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\service\OrderService;

class OrderController extends BaseController
{
    private  OrderService $orderService;
    public function __construct()
    {
        $this->orderService = new OrderService();
    }

    public function index()
    {
        $this->view()->load('Admin.Order.Index', $this->orderService->getOrders(), 'admin');
    }
}