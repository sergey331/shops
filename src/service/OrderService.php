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
    private NotificationService $notificationService;

    public function __construct(
        ShippingService $shippingService = new ShippingService(),
        UserService $userService = new UserService(),
        DiscountService $discountService = new DiscountService(),
        NotificationService $notificationService = new NotificationService()
    ) {
        $this->shippingService = $shippingService;
        $this->userService = $userService;
        $this->discountService = $discountService;
        $this->notificationService = $notificationService;
    }

    public function getOrders(): array
    {
        $orders = model('Order')
            ->with(['status'])
            ->whereOp('status_id', '!=', 0)
            ->paginate();

        return [
            'orders' => $orders,
            'tableData' => $this->getTableData($orders)
        ];
    }

    /**
     * @throws Exception
     */
    public function step1(): array
    {
        $view = $this->getStepView();
        $sessionData = $this->getOrderData();

        $step = $sessionData['step']
            ?? (auth()->check() ? 'personal_info' : 'type');

        return [
            'step' => $step,
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
            return $this->fail("No access to step '{$step}'");
        }

        $required = [
            'payment' => 'address_id',
            'confirm' => 'payment_id',
        ];

        if (isset($required[$step]) && empty($sessionData[$required[$step]])) {
            return $this->fail("No access to step '{$step}'");
        }

        $this->updateOrderData(array_merge($sessionData, request()->all()));

        return $this->renderStep();
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

        [$user, $address] = $this->handleUserAndAddress($data, $sessionData);

        $payload = array_merge($sessionData, $data, [
            'user_id'    => $user?->id,
            'address_id' => $address->id,
            'step'       => 'payment'
        ]);

        $this->updateOrderData($payload);

        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.Payment", [
                'payments'   => $this->getPayments(),
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

        $order = $this->createOrder(
            $orderData,
            $shippingMethod->id,
            $shippingItem->id,
            $paymentId,
            $totals
        );

        $this->createOrderProduct($order->id);
        $this->createOrderHistory($order->id);

        $orderData = array_merge($orderData, [
            'step' => 'confirm',
            'payment_id' => $paymentId,
            'order_id' => $order->id
        ]);

        $this->updateOrderData($orderData);

        $order = model('Order')->with(['books','shippingMethodItem'])->find($order->id);
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
        $orderId = request()->input('order_id');

        $this->createOrderHistory($orderId, OrderStatus::PENDING_ID, 'Order pending');
        $this->updateOrderStatus($orderId, OrderStatus::PENDING_ID);

        $this->removeOrderSession();
        $this->removeCartProduct();

        $this->notificationService->notifyOrder($orderId);

        return [
            'success' => true,
            'content' => view()->getHtml("Checkout.Success")
        ];
    }

    /**
     * @throws Exception
     */
    private function handleUserAndAddress(array $data, array $sessionData): array
    {
        $user = auth()->user();

        $address = $this->userService->saveAddress($user, $data);

        if (!$user && ($sessionData['checkout_type'] ?? null) === 'register') {
            $user = $this->userService->saveUser($data, $address);
        } elseif ($user) {
            $user = $this->userService->saveUser($data, $address, $user);
        }

        return [$user, $address];
    }

    private function renderStep(): array
    {
        $view = $this->getStepView();

        return [
            'success' => true,
            'content' => view()->getHtml($view['path'], $view['data'])
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

        $step = $orderData['step'] ?? ($user ? 'personal_info' : '');
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
                    'order' => model('Order')->with(['books','shippingMethodItem'])->find($orderData['order_id'] ?? 0)
                ]
            ],
            default => [
                'path' => 'Checkout.ChooseType',
                'data' => ['type' => $checkoutType]
            ],
        };
    }

    private function createOrder($orderData, $shippingMethodId, $shippingItemId, $paymentId, $totals)
    {
        return model('Order')->create([
            'first_name' => $orderData['first_name'],
            'last_name' => $orderData['last_name'],
            'email' => $orderData['email'],
            'address_id' => $orderData['address_id'],
            'user_id' => $orderData['user_id'] ?? null,
            'payment_id' => $paymentId,
            'shipping_id' => $shippingMethodId,
            'shipping_item_id' => $shippingItemId,
            'status_id' => 0,
            'subtotal' => $totals['subtotal'],
            'discounted' => $totals['discounted'],
            'total' => $totals['total']
        ]);
    }

    private function updateOrderStatus($orderId, $statusId): void
    {
        model('Order')->where(['id' => $orderId])->update(['status_id' => $statusId]);
    }

    private function createOrderProduct($orderId): void
    {
        foreach (cart()->get() as $book) {
            model('OrderBook')->create([
                'book_id' => $book->getBookId(),
                'name' => $book->getBook()->title,
                'price' => $book->getBook()->price,
                'quantity' => $book->getQty(),
                'order_id' => $orderId
            ]);
        }
    }

    private function updateOrderData(array $data): void
    {
        session()->set('order', $data);
    }

    private function createOrderHistory($orderId, $status = 0, $comment = 'Order Created'): void
    {
        model('OrderHistory')->create([
            'comment' => $comment,
            'status_id' => $status,
            'order_id' => $orderId
        ]);
    }

    /**
     * @throws Exception
     */
    private function removeOrderSession(): void
    {
        session()->remove('order');
     }
    private function removeCartProduct(): void
    {
        cart()->removeAll();
    }

    private function fail(string $message): array
    {
        return [
            'success' => false,
            'content' => $message
        ];
    }

    private function getTableData($orders): Table
    {
        $table = new Table($orders->data, [
            "#" => ['field' => 'id'],
            "First Name" => ['field' => 'first_name'],
            "Last Name" => ['field' => 'last_name'],
            "Email" => ['field' => 'email'],
            "Status" => ['field' => 'status.name'],
            "Total (" . setting()->currency->code . ")" => ['field' => 'total'],
            "Actions" => [
                'callback' => function ($row) {
                    return '
                        <div class="d-flex gap-1">
                            <a href="/admin/orders/' . $row->id . '" class="btn btn-sm btn-primary text-white">Show</a>
                        </div>
                    ';
                },
            ]
        ]);

        return $table->setTableAttributes(['class' => 'table']);
    }
}