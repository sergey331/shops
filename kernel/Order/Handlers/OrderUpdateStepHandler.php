<?php

namespace Kernel\Order\Handlers;

use Exception;
use Kernel\Order\Interface\OrderHandlerInterface;
use Kernel\Order\OrderResponse;
use Kernel\Order\Service\ViewRender;
use Kernel\Order\SessionData;

class OrderUpdateStepHandler implements OrderHandlerInterface
{

    /**
     * @throws Exception
     */
    public function handle(): array
    {
        $sessionData = SessionData::get();
        $step = request()->input('step');
        if (!$sessionData) {
            return [
                'success' => false,
                'content' => "No access to step '{$step}'"
            ];
        }
        $required = [
            'payment' => 'address_id',
            'confirm' => 'payment_id',
        ];

        if (isset($required[$step]) && empty($sessionData[$required[$step]])) {
            return [
                'success' => false,
                'content' => "No access to step '{$step}'"
            ];
        }

        SessionData::set(array_merge($sessionData, request()->all()));
        $view = ViewRender::getStepView();
        return OrderResponse::render($view['path'], $view['data']);
    }
}