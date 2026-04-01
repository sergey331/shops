<?php

namespace Kernel\Order\Handlers;

use Exception;
use Kernel\Order\Interface\OrderHandlerInterface;
use Kernel\Order\OrderResponse;
use Kernel\Order\Service\User;
use Kernel\Order\SessionData;
use Kernel\Validator\Validator;
use Shop\rules\CheckoutPersonalInfoRules;

class OrderPersonalInfoHandler implements OrderHandlerInterface
{

    /**
     * @throws Exception
     */
    public function handle(): array
    {
        $data = request()->all();
        $sessionData = SessionData::get() ?? [];

        $validator = Validator::make($data, CheckoutPersonalInfoRules::rules());

        if (!$validator->validate()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }

        [$user, $address] = $this->handleUserAndAddress($data, $sessionData);

        $payload = array_merge($sessionData, $data, [
            'user_id'    => $user?->id,
            'address_id' => $address->id,
            'step'       => 'payment'
        ]);
        SessionData::set($payload);

        return OrderResponse::render("Checkout.Payment", [
            'payments'   => model('Payment')->get(),
            'payment_id' => $payload['payment_id'] ?? null
        ]);
    }

    /**
     * @throws Exception
     */
    private function handleUserAndAddress(array $data, array $sessionData): array
    {
        $userService = new User();
        $user = auth()->user();

        $address = $userService->saveAddress($user, $data);

        if (!$user && ($sessionData['checkout_type'] ?? null) === 'register') {
            $user = $userService->saveUser($data, $address);
        } elseif ($user) {
            $user = $userService->saveUser($data, $address, $user);
        }

        return [$user, $address];
    }
}