<?php

namespace Shop\service;

use Exception;
use Kernel\Order\Factory\OrderFactory;
use Kernel\Order\Order;
use Kernel\Order\Service\ViewRender;
use Kernel\Order\SessionData;
use Kernel\Service\BaseService;
use Kernel\Table\Table;

class OrderService extends BaseService
{

    /**
     * @throws Exception
     */
    public function loadProcess(): array
    {
        $view = ViewRender::getStepView();
        $sessionData = SessionData::get();

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

    public function processCheckout()
    {
        $step = request()->has('step')
            ? 'updateStep'
            : (SessionData::get()['step'] ?? '');

        return (new Order())->process(
            OrderFactory::make($step)
        );
    }
    /**
     * @throws Exception
     */
    public function clearOrder(): void
    {
        SessionData::clear();
    }
    /**
     * @throws Exception
     */
    public function getOrders(): array
    {
        $orders = model('Order')
            ->with(['status'])
            ->whereOp('status_id', '!=', 0)
            ->orderBy('id', 'DESC')
            ->paginate();
        return [
            'orders' => $orders,
            'tableData' => $this->getTableData($orders)
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