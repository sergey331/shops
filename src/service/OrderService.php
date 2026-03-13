<?php

namespace Shop\service;

use Kernel\Service\BaseService;
use Kernel\Validator\Validator;
use Shop\rules\CheckoutPersonalInfoRules;

class OrderService extends BaseService
{
    private ShippingService $shippingService;
    private UserService $userService;
    private DiscountService $discountService;

    public function __construct()
    {
        $this->shippingService = new ShippingService();
        $this->discountService = new DiscountService();
        $this->userService = new UserService();
    }

    public function step1(): string
    {
        if (!auth()->check()) {
            $view = $this->getStepView();
            return view()->getHtml($view['path'], $view['data']);
        }
        return '';
    }
    public function saveStep1(): array
    {
        $data = request()->all();

        if (empty($data['checkout_type'])) {
            return ['success' => false];
        }
        $data['step'] = 'personal_info';
        $this->updateOrderData($data);
        $type = ucfirst($data['checkout_type']);
        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.$type", [
                'regions' => $this->getRegions()
            ])
        ];
    }
    public function savePersonalInfo(): array
    {
        $data = request()->all();
        $sessionData = $this->getOrderData();
        $validator = Validator::make($data, CheckoutPersonalInfoRules::rules());
        if (!$validator->validate()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }
        $address = $this->userService->createAddress($data);
        $data['address_id'] = $address->id;
        if (($sessionData['checkout_type'] ?? null) === 'register') {
            $user = $this->userService->register($data, $address);
            $data['user_id'] = $user->id;
        }
        $data['step'] = 'payment';
        $this->updateOrderData(array_merge($sessionData, $data));
        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.Payment", [
                'payments' => $this->getPayments()
            ])
        ];
    }
    public function savePaymentMethod(): array
    {
        $paymentId = request()->input('payment_id');

        if (!$paymentId) {
            return [
                'success' => false,
                'errors' => ['payment is required']
            ];
        }
        $orderData = $this->getOrderData();
        $shippingMethod = $this->shippingService->getShippingMethod($orderData['region_id']);
        $totals = $this->discountService->getTotals();

        $shippingItem = $this->shippingService->getShippingMethodItem(
            $shippingMethod->items,
            $totals['total']
        );

        $totals['total'] += (int) $shippingItem->price;

        $order = $this->createOrder($orderData,$shippingMethod->id,$shippingItem->id,$paymentId,$totals);

       $this->createOrderProduct($order->id);
       $this->createOrderHistory($order->id);

        $order = model('Order')->find($order->id);
        $orderData['step'] = 'confirm';
        $this->updateOrderData(array_merge($orderData, ['order_id' => $order->id]));
        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.Confirm", [
                'order' => $order
            ])
        ];
    }
    private function getRegions()
    {
        return model('Region')->get();
    }
    private function getPayments()
    {
        return model('Payment')->get();
    }
    private function getOrderData()
    {
        return session()->get('order');
    }
    private function getStepView(): array
    {
        $orderData = $this->getOrderData();

        if (!$orderData) {
            return ['path' => 'Checkout.ChooseType', 'data' => []];
        }

        $step = $orderData['step'] ?? '';
        return match ($step) {
            'personal_info' => [
                'path' => "Checkout." . ucfirst($orderData['checkout_type'] ?? ''),
                'data' => ['regions' => $this->getRegions()]
            ],
            'payment' => [
                'path' => "Checkout.Payment",
                'data' => ['payments' => $this->getPayments()]
            ],
            'confirm' => [
                'path' => "Checkout.Confirm",
                'data' => ['order' => model('Order')->find($orderData['order_id'] ?? 0)]
            ],
            default => ['path' => 'Checkout.ChooseType', 'data' => []],
        };
    }
    private function createOrder($orderData,$shipping_method_id,$shipping_method_item_id,$paymentId,$totals)
    {
        return model('Order')->create([
            'first_name' => $orderData['first_name'],
            'last_name' => $orderData['last_name'],
            'email' => $orderData['email'],
            'address_id' => $orderData['address_id'],
            'user_id' => $orderData['user_id'] ?? null,
            'payment_id' => $paymentId,
            'shipping_id' => $shipping_method_id,
            'shipping_item_id' => $shipping_method_item_id,
            'status_id' => 0,
            'subtotal' => $totals['subtotal'],
            'discounted' => $totals['discounted'],
            'total' => $totals['total']
        ]);
    }
    private function createOrderProduct($order_id): void
    {
        foreach (cart()->get() as $book) {
            model('OrderBook')->create([
                'book_id' => $book->getBookId(),
                'name' => $book->getBook()->title,
                'price' => $book->getBook()->price,
                'quantity' => $book->getQty(),
                'order_id' => $order_id
            ]);
        }
    }
    private function updateOrderData(array $data): void
    {
        session()->set('order', $data);
    }
    private function createOrderHistory($order_id): void
    {
        model('OrderHistory')->create([
            'comment' => 'Order Created',
            'status_id' => 0,
            'order_id' => $order_id
        ]);
    }
}