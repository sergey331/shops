<?php

namespace Shop\controllers\admin;

use Shop\model\Discount;
use Shop\service\DiscountService;
use Kernel\Controller\BaseController;

class DiscountController extends BaseController
{
    private DiscountService $discountService;
    public function __construct()
    {
        $this->discountService = new DiscountService();
    }
    public function index()
    {
        $this->view()->load('Admin.Discount.Index', $this->discountService->getDiscountsData(), 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.Discount.Create', ['forms' => $this->discountService->getDiscountForm('/admin/discounts/store')], 'admin');
    }

    public function store() 
    {
        if (!$this->discountService->storeOrUpdate()) {
            $this->redirect()->back();
        }

        $this->redirect()->to('/admin/discounts');
    }

    public function edit(Discount $discount)
    {
        $this->view()->load('Admin.Discount.Edit', ['forms' => $this->discountService->getDiscountForm('/admin/discounts/update/'.$discount->id, $discount)], 'admin');

    }
    public function update(Discount $discount)
    {
        if (!$this->discountService->storeOrUpdate($discount)) {
            $this->redirect()->back();
        }

        $this->redirect()->to('/admin/discounts');
    }
    public function delete(Discount $discount) {
        $this->discountService->delete($discount);
        $this->redirect()->to('/admin/discounts');
    }
}