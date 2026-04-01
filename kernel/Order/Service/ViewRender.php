<?php

namespace Kernel\Order\Service;

use Exception;
use Kernel\Order\SessionData;

class ViewRender
{
    /**
     * @throws Exception
     */
    public static function getStepView(): array
    {
        $orderData = SessionData::get() ?? [];
        $user = auth()->user();

        if (empty($orderData) && !$user) {
            return [
                'path' => 'Checkout.ChooseType',
                'data' => ['type' => '']
            ];
        }

        $step = $orderData['step'] ?? ($user ? 'personal_info' : '');
        $checkoutType = $orderData['checkout_type'] ?? '';

        if ($step === 'personal_info') {
            if ($user) {
                return [
                    'path' => 'Checkout.Auth',
                    'data' => [
                        'regions' => model('Region')->get(),
                        'orderData' => $orderData,
                        'user' => $user,
                        'address' => $user->with(['address'])->address ?? null
                    ]
                ];
            }

            return [
                'path' => "Checkout." . ucfirst($checkoutType),
                'data' => [
                    'regions' => model('Region')->get(),
                    'orderData' => $orderData
                ]
            ];
        }

        return match ($step) {
            'payment' => [
                'path' => "Checkout.Payment",
                'data' => [
                    'payments' => model('Payment')->get(),
                    'payment_id' => $orderData['payment_id'] ?? null
                ]
            ],
            'confirm' => [
                'path' => "Checkout.Confirm",
                'data' => [
                    'order' => model('Order')->with(['books','shippingMethodItem'])->find($orderData['order_id'] ?? 0)
                ]
            ],
            default => [
                'path' => 'Checkout.ChooseType',
                'data' => ['type' => $checkoutType]
            ],
        };
    }
}