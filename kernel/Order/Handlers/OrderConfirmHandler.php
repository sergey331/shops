<?php

namespace Kernel\Order\Handlers;

use Exception;
use Kernel\Email\Handlers\OrderEmailHandler;
use Kernel\Order\Interface\OrderHandlerInterface;
use Kernel\Order\OrderResponse;
use Kernel\Order\Service\Email;
use Kernel\Order\Service\Notification;
use Kernel\Order\Service\Order;
use Shop\model\OrderStatus;

class OrderConfirmHandler implements OrderHandlerInterface
{

    /**
     * @throws Exception
     */
    public function handle(): array
    {
        $orderId = request()->input('order_id');

        $orderHistory = new Order();
        $orderHistory->createOrderHistory($orderId, OrderStatus::PENDING_ID, 'Order pending');
        $orderHistory->updateOrderStatus($orderId, OrderStatus::PENDING_ID);

        if (setting()->order_email) {
            $emailService = new Email(new OrderEmailHandler());
            $emailService->send($orderId);
            (new Notification())->notifyOrder($orderId);
        }

        return OrderResponse::render("Checkout.Success",confirmed: true);
    }
}