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

    public function show(Discount $discount)
    {
        
    }
}