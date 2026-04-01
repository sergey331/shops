<?php

namespace Kernel\Order\Service;

use Exception;

class Notification
{
    /**
     * @throws Exception
     */
    public function notifyOrder($order_id): void
    {
        model('Notification')->create([
            'title' => 'New order #' . $order_id . ' has been placed by John Doe.',
            'type' => 'order',
            'item_id' => $order_id
        ]);
    }
}