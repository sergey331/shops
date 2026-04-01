<?php

namespace Kernel\Order\Handlers;

use Exception;
use Kernel\Order\Interface\OrderHandlerInterface;
use Kernel\Order\OrderResponse;
use Kernel\Order\Service\Discount;
use Kernel\Order\Service\Order;
use Kernel\Order\Service\Shipping;
use Kernel\Order\SessionData;

class OrderPaymentHandler implements OrderHandlerInterface
{

    /**
     * @throws Exception
     */
    public function handle(): array
    {
        $paymentId = request()->input('payment_id');

        if (!$paymentId) {
            return [
                'success' => false,
                'errors' => ['payment is required']
            ];
        }

        $orderData = SessionData::get();

        $shippingService = new Shipping();
        $shippingMethod = $shippingService->getShippingMethod($orderData['region_id']);

        $discountService = new  Discount();
        $totals = $discountService->getTotals();

        $shippingItem = $shippingService->getShippingMethodItem(
            $shippingMethod->items,
            $totals['total']
        );
        $totals['total'] += (int)$shippingItem->price;

        $orderService = new Order();

        $order = $orderService->createOrder(
            $orderData,
            $shippingMethod->id,
            $shippingItem->id,
            $paymentId,
            $totals
        );

        $orderService->createOrderProduct($order->id);
        $orderService->createOrderHistory($order->id);

        $orderData = array_merge($orderData, [
            'step' => 'confirm',
            'payment_id' => $paymentId,
            'order_id' => $order->id
        ]);

        SessionData::set($orderData);

        $order = model('Order')->with(['books','shippingMethodItem'])->find($order->id);
        return OrderResponse::render("Checkout.Confirm", [
            'order' => $order
        ]);
    }
}