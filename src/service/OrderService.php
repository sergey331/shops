<?php

namespace Shop\service;

use Kernel\Service\BaseService;
use Kernel\Validator\Validator;
use Shop\rules\CheckoutPersonalInfoRules;

class OrderService extends BaseService
{
    public function step1(): string
    {
        if (!auth()->check()) {
            return view()->getHtml('Checkout.ChooseType',[]);
        }

        return '';
    }

    public function saveStep1(): array
    {
        $data = request()->all();

        if (empty($data['checkout_type'])) {
            return ['success' => false];
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

        $address = $this->createAddress($data);
        $data['address_id'] = $address->id;

        if (($sessionData['checkout_type'] ?? null) === 'register') {
            $user = $this->register($data, $address);
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

        $shippingMethod = $this->getShippingMethod($orderData['region_id']);
        $totals = $this->getTotals();

        $shippingItem = $this->getShippingMethodItem(
            $shippingMethod->items,
            $totals['total']
        );

        $totals['total'] += (int) $shippingItem->price;

        $order = model('Order')->create([
            'first_name' => $orderData['first_name'],
            'last_name' => $orderData['last_name'],
            'email' => $orderData['email'],
            'address_id' => $orderData['address_id'],
            'user_id' => $orderData['user_id'] ?? null,
            'payment_id' => $paymentId,
            'shipping_id' => $shippingMethod->id,
            'shipping_item_id' => $shippingItem->id,
            'status_id' => 0,
            'subtotal' => $totals['subtotal'],
            'discounted' => $totals['discounted'],
            'total' => $totals['total']
        ]);

        foreach (cart()->get() as $book) {
            model('OrderBook')->create([
                'book_id' => $book->getBookId(),
                'name' => $book->getBook()->title,
                'price' => $book->getBook()->price,
                'quantity' => $book->getQty(),
                'order_id' => $order->id
            ]);
        }

        model('OrderHistory')->create([
            'comment' => 'Order Created',
            'status_id' => 0,
            'order_id' => $order->id
        ]);

        session()->set('order', array_merge($orderData, ['order_id' => $order->id]));

        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.Confirm", [
                'order' => $order
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

    private function getShippingMethod($regionId)
    {
        $geo = model('GeoZone')->where(['region_id' => $regionId])->first();
        return $geo->shippingMethod ?? null;
    }

    private function getShippingMethodItem($items, $total)
    {
        $total = (int) $total;
        return array_find($items, function ($item) use ($total) {
            $min = (int) $item->min_price;
            $max = $item->max_price ? (int) $item->max_price : null;
            return $total >= $min && ($max === null || $total <= $max);
        });
    }

    private function createAddress(array $data)
    {
        return model('Address')->create([
            'phone' => $data['phone'],
            'region_id' => $data['region_id'],
            'city' => $data['city'],
            'address' => $data['address'],
            'address1' => $data['address1'],
            'zip' => $data['zip']
        ]);
    }

    private function getTotals(): array
    {
        $total = (float) str_replace(',', '', cart()->total());
        $discounted = 0;

        foreach ($this->getDiscounts() as $discount) {

            if ($discount->min_order_amount && $total < $discount->min_order_amount) {
                continue;
            }

            if ($discount->type === 'percentage') {
                $value = $total * $discount->value / 100;
            } else {
                $value = $discount->value;
            }

            $discounted += $value;
        }

        return [
            'subtotal' => $total,
            'discounted' => $discounted,
            'total' => $total - $discounted
        ];
    }

    private function getDiscounts()
    {
        $today = date('Y-m-d');

        return model("Discount")
            ->where(['is_active' => true])
            ->whereOp('started_at', '<=', $today)
            ->whereOp('finished_at', '>=', $today)
            ->get();
    }

    private function register($data, $address)
    {
        return model("User")->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => lcfirst($data['first_name']) . '_' . lcfirst($data['last_name']),
            'email' => $data['email'],
            'password' => $data['password'],
            'address_id' => $address->id
        ]);
    }

    private function getOrderData()
    {
        return session()->get('order');
    }
}