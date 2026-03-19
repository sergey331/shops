<?php

namespace Shop\service;

use Exception;
use Kernel\Service\BaseService;
use Kernel\Table\Table;
use Kernel\Validator\Validator;
use Shop\model\OrderStatus;
use Shop\rules\CheckoutPersonalInfoRules;

class OrderService extends BaseService
{
    private ShippingService $shippingService;
    private UserService $userService;
    private DiscountService $discountService;

    public function getOrders(): array
    {
        $discounts = model('Order')->paginate();
        return [
            'discounts' => $discounts,
            'tableData' => $this->getTableData($discounts)
        ];
    }
    public function __construct()
    {
        $this->shippingService = new ShippingService();
        $this->discountService = new DiscountService();
        $this->userService = new UserService();
    }

    /**
     * @throws Exception
     */
    public function step1(): array
    {
        $view = $this->getStepView();
        $sessionData = $this->getOrderData();
        return [
            'step' => $sessionData['step'] ?? auth()->check() ? 'personal_info' : 'type',
            'content' => view()->getHtml($view['path'], $view['data'])
        ];
    }

    /**
     * @throws Exception
     */
    public function updateStep(): array
    {
        $sessionData = $this->getOrderData();
        $step = request()->input('step');

        if (!$sessionData) {
            return $this->fail('You dont have permissions for this "' . $step . '" step');
        }

        $rules = [
            'payment' => 'address_id',
            'confirm' => 'payment_id',
        ];

        if (isset($rules[$step]) && !isset($sessionData[$rules[$step]])) {
            return $this->fail('You dont have permissions for this "' . $step . '" step');
        }

        $this->updateOrderData(array_merge($sessionData, request()->all()));

        $view = $this->getStepView();

        return [
            'success' => true,
            'content' => view()->getHtml($view['path'], $view['data'])
        ];
    }

    /**
     * @throws Exception
     */
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
                'regions' => $this->getRegions(),
                'orderData' => $this->getOrderData()
            ])
        ];
    }

    /**
     * @throws Exception
     */
    public function savePersonalInfo(): array
    {
        $data = request()->all();
        $sessionData = $this->getOrderData() ?? [];

        $validator = Validator::make($data, CheckoutPersonalInfoRules::rules());

        if (!$validator->validate()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }

        $user = auth()->user();
        if (!$user) {
            $address = $this->userService->saveAddress((object)[], $data);
            if (($sessionData['checkout_type'] ?? null) === 'register') {
                $user = $this->userService->saveUser($data, $address);
            }
        } else {
            $address = $this->userService->saveAddress($user, $data);
            $user = $this->userService->saveUser($data, $address, $user);
        }
        $payload = array_merge($sessionData, [
            'user_id' => $user->id ?? null,
            'address_id' => $address->id ?? null,
            'step' => 'payment'
        ]);

        $this->updateOrderData($payload);
        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.Payment", [
                'payments' => $this->getPayments(),
                'payment_id' => $payload['payment_id'] ?? null
            ])
        ];
    }

    /**
     * @throws Exception
     */
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

        $totals['total'] += (int)$shippingItem->price;

        $order = $this->createOrder($orderData, $shippingMethod->id, $shippingItem->id, $paymentId, $totals);

        $this->createOrderProduct($order->id);
        $this->createOrderHistory($order->id);

        $order = model('Order')->find($order->id);
        $orderData['step'] = 'confirm';
        $orderData['payment_id'] = $paymentId;
        $this->updateOrderData(array_merge($orderData, ['order_id' => $order->id]));
        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.Confirm", [
                'order' => $order
            ])
        ];
    }

    /**
     * @throws Exception
     */
    public function confirm(): array
    {
        $order_id = request()->input('order_id');
        $this->createOrderHistory($order_id, OrderStatus::PENDING_ID, 'Order pending');
        $this->removeOrderSession();
        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.Success")
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

    /**
     * @throws Exception
     */
    private function getOrderData()
    {
        return session()->get('order');
    }

    /**
     * @throws Exception
     */
    private function getStepView(): array
    {
        $orderData = $this->getOrderData() ?? [];
        $user = auth()->user();


        if (empty($orderData) && !$user) {
            return [
                'path' => 'Checkout.ChooseType',
                'data' => ['type' => '']
            ];
        }

        $step = $orderData['step'] ?? $user ? "personal_info" : '';
        $checkoutType = $orderData['checkout_type'] ?? '';


        if ($step === 'personal_info') {
            if ($user) {
                return [
                    'path' => 'Checkout.Auth',
                    'data' => [
                        'regions' => $this->getRegions(),
                        'orderData' => $orderData,
                        'user' => $user,
                        'address' => $user->with(['address'])->address ?? null
                    ]
                ];
            }
            return [
                'path' => "Checkout." . ucfirst($checkoutType),
                'data' => [
                    'regions' => $this->getRegions(),
                    'orderData' => $orderData
                ]
            ];
        }
        // 🔹 OTHER STEPS
        return match ($step) {

            'payment' => [
                'path' => "Checkout.Payment",
                'data' => [
                    'payments' => $this->getPayments(),
                    'payment_id' => $orderData['payment_id'] ?? null
                ]
            ],

            'confirm' => [
                'path' => "Checkout.Confirm",
                'data' => [
                    'order' => model('Order')->find($orderData['order_id'] ?? 0)
                ]
            ],

            default => [
                'path' => 'Checkout.ChooseType',
                'data' => ['type' => $checkoutType]
            ],
        };
    }

    private function createOrder($orderData, $shipping_method_id, $shipping_method_item_id, $paymentId, $totals)
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

    /**
     * @throws Exception
     */
    private function updateOrderData(array $data): void
    {
        session()->set('order', $data);
    }

    private function createOrderHistory($order_id, $status = 0, $comment = 'Order Created'): void
    {
        model('OrderHistory')->create([
            'comment' => $comment,
            'status_id' => $status,
            'order_id' => $order_id
        ]);
    }

    private function fail(string $message): array
    {
        return [
            'success' => false,
            'content' => $message
        ];
    }

    /**
     * @throws Exception
     */
    private function removeOrderSession()
    {
        session()->remove('order');
    }

    private function getTableData($discounts)
    {
        $table = new Table($discounts->data, [
            "#" => ['field' => 'id'],
            "First Name" => ['field' => 'first_name'],
            "Last Name" => ['field' => 'last_name'],
            "email" => ['field' => 'email'],
            "Actions" => [
                'callback' => function ($row) {
                    $id = $row->id;
                    return '
                        <div class="d-flex gap-1">
                            <a href="/admin/orders/' . $id . '" class="btn btn-sm btn-primary text-white">Show</a>
                        </div>
                    ';
                },
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}