<?php

namespace Shop\service;

use Kernel\Service\BaseService;
use Kernel\Validator\Validator;
use Shop\rules\CheckoutPersonalInfoRules;

class OrderService extends BaseService
{
    public function step1(): string
    {
        $content = '';
        if (!auth()->check()) {
            $content = view()->getHtml('Checkout.ChooseType', []);
        }
        return $content;
    }

    public function saveStep1(): array
    {
        $data = request()->all();

        if (empty($data['checkout_type'])) {
            return [
                'success' => false
            ];
        }
        session()->set('order', $data);
        $type = ucfirst($data['checkout_type']);

        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.$type", [
                'regions' => $this->getRegions()
            ])
        ];
    }

    public function savePersonalInfo()
    {
        $data = request()->all();
        $sessionData = session()->get('order');

        $validator = Validator::make($data, CheckoutPersonalInfoRules::rules());

        if (!$validator->validate()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }

        if ($sessionData['checkout_type'] === 'register') {
            $user = $this->register($data);
            $data['user_id'] = $user->id;
        }

        session()->set('order', array_merge($sessionData, $data));

        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.Payment", [
                'payments' => $this->getPayments()
            ])
        ];
    }

    public function getRegions()
    {
        return model('Region')->get();
    }
    public function getPayments()
    {
        return model('Payment')->get();
    }

    private function register($data)
    {
        $address = model('Address')->create([
            'phone' => $data['phone'],
            'region_id' => $data['region_id'],
            'city' => $data['city'],
            'address' => $data['address'],
            'address1' => $data['address1'],
            'zip' => $data['zip'],
        ]);
        return model("User")->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => lcfirst($data['first_name']) . '_' . lcfirst($data['last_name']),
            'email' => $data['email'],
            'password' => $data['password'],
            'address_id' => $address->id,
        ]);
    }
}