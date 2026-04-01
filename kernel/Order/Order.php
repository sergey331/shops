<?php

namespace Kernel\Order;

use Kernel\Order\Interface\OrderHandlerInterface;
class Order
{
    public function process(OrderHandlerInterface $handler)
    {
        return $handler->handle();
    }
}