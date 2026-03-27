<?php

namespace Shop\service;

use Exception;
use Kernel\Service\BaseService;

class NotificationService extends BaseService
{

    /**
     * @throws Exception
     */
    public function getNotification(): array
    {
        return ['notifications' => model('Notification')->where(['is_read' => 0])->get()];
    }

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