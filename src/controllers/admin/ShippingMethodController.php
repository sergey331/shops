<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\ShippingMethod;
use Shop\service\ShippingMethodService;

class ShippingMethodController extends BaseController
{

    private ShippingMethodService $shippingMethodService;

    public function __construct()
    {
        $this->shippingMethodService = new ShippingMethodService();
    }

    public function index()
    {
        $data = $this->shippingMethodService->getShippingMethods();
        $this->view()->load('Admin.ShippingMethods.Index', [
            'shippingMethods' => $data['shippingMethods'],
            'tableData' => $data['tableData']
        ], 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.ShippingMethods.Create', [
            'form' => $this->shippingMethodService->getForms('/admin/shipping-methods/store')
        ], 'admin');
    }

    public function store(): void
    {
        if (!$this->shippingMethodService->storeOrUpdate()) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/shipping-methods');
    }

    public function edit(ShippingMethod $shippingMethod)
    {
        $this->view()->load('Admin.Category.Edit', [
            'form' => $this->shippingMethodService->getForms("/admin/shipping-methods/{$shippingMethod->id}",$shippingMethod)
        ], 'admin');
    }

    public function update(ShippingMethod $shippingMethod)
    {
        if (!$this->shippingMethodService->storeOrUpdate($shippingMethod)) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/shipping-methods');
    }

    public function delete(ShippingMethod $shippingMethod)
    {
        $this->shippingMethodService->delete($shippingMethod);

        $this->redirect()->to('/admin/shipping-methods');
    }
}