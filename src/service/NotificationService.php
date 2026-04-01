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
        return [
            'notifications' => model('Notification')
                ->where(['is_read' => 0])
                ->orderBy('created_at', 'DESC')
                ->get()
        ];
    }
}