<?php

namespace Kernel\Order\Service;

use Exception;

class Order
{
    /**
     * @throws Exception
     */
    public function createOrder($orderData, $shippingMethodId, $shippingItemId, $paymentId, $totals)
    {
        return model('Order')->create([
            'first_name' => $orderData['first_name'],
            'last_name' => $orderData['last_name'],
            'email' => $orderData['email'],
            'address_id' => $orderData['address_id'],
            'user_id' => $orderData['user_id'] ?? null,
            'payment_id' => $paymentId,
            'shipping_id' => $shippingMethodId,
            'shipping_item_id' => $shippingItemId,
            'status_id' => 0,
            'subtotal' => $totals['subtotal'],
            'discounted' => $totals['discounted'],
            'total' => $totals['total']
        ]);
    }

    /**
     * @throws Exception
     */
    public function updateOrderStatus($orderId, $statusId): void
    {
        model('Order')->where(['id' => $orderId])->update(['status_id' => $statusId]);
    }

    /**
     * @throws Exception
     */
    public function createOrderProduct($orderId): void
    {
        foreach (cart()->get() as $book) {
            model('OrderBook')->create([
                'book_id' => $book->getBookId(),
                'name' => $book->getBook()->title,
                'price' => $book->getBook()->price,
                'quantity' => $book->getQty(),
                'order_id' => $orderId
            ]);
        }
    }

    /**
     * @throws Exception
     */
    public function createOrderHistory($orderId, $status = 0, $comment = 'Order Created'): void
    {
        model('OrderHistory')->create([
            'comment' => $comment,
            'status_id' => $status,
            'order_id' => $orderId
        ]);
    }
}