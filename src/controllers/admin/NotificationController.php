<?php

namespace Shop\controllers\admin;

use Exception;
use Kernel\Controller\BaseController;
use Shop\service\NotificationService;

class NotificationController extends BaseController
{
    private NotificationService $notificationService;
    public function __construct()
    {
        $this->notificationService = new NotificationService();
    }

    /**
     * @throws Exception
     */
    public function index(): void
    {

        $this->response()->html(
            $this->view()->getHtml(
                'Component.Layout.Notification.notificationItems',
                $this->notificationService->getNotification()
            )
        );
    }
}