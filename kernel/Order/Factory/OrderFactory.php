<?php

namespace Kernel\Order\Factory;

use Kernel\Order\Handlers\OrderConfirmHandler;
use Kernel\Order\Handlers\OrderPaymentHandler;
use Kernel\Order\Handlers\OrderPersonalInfoHandler;
use Kernel\Order\Handlers\OrderTypeHandler;
use Kernel\Order\Handlers\OrderUpdateStepHandler;
use Kernel\Order\Interface\OrderHandlerInterface;

class OrderFactory
{
    public static function make(string $step): OrderHandlerInterface
    {
        return match ($step) {
            'personal_info' => new OrderPersonalInfoHandler(),
            'payment' => new OrderPaymentHandler(),
            'confirm' => new OrderConfirmHandler(),
            'updateStep' => new OrderUpdateStepHandler(),
            default => new OrderTypeHandler(),
        };
    }
}