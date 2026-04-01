<?php

namespace Kernel\Order\Handlers;

use Exception;
use Kernel\Order\Interface\OrderHandlerInterface;
use Kernel\Order\OrderResponse;
use Kernel\Order\SessionData;

class OrderTypeHandler implements OrderHandlerInterface
{
    /**
     * @throws Exception
     */
    public function handle(): array
    {
        $data = request()->all();
        if (empty($data['checkout_type'])) {
            return ['success' => false];
        }
        $data['step'] = 'personal_info';
        SessionData::set($data);
        $type = ucfirst($data['checkout_type']);
        return OrderResponse::render("Checkout.$type", [
            'regions' => $this->getRegions(),
            'orderData' => SessionData::get()
        ]);
    }

    /**
     * @throws Exception
     */
    private function getRegions()
    {
        return model('Region')->get();
    }
}