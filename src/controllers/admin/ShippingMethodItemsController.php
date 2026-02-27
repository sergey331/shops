<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\ShippingMethod;
use Shop\model\ShippingMethodItem;
use Shop\service\ShippingMethodItemsService;

class ShippingMethodItemsController extends BaseController
{

    private ShippingMethodItemsService $shippingMethodItemsService;

    public function __construct()
    {
        $this->shippingMethodItemsService = new ShippingMethodItemsService();
    }

    public function index(ShippingMethod $shippingMethod)
    {
        $data = $this->shippingMethodItemsService->getShippingMethodItems($shippingMethod);
        $this->view()->load('Admin.ShippingMethods.Items.Index', [
            'shippingMethodItems' => $data['shippingMethodItems'],
            'shippingMethod' => $shippingMethod,
            'tableData' => $data['tableData']
        ], 'admin');
    }

    public function create(ShippingMethod $shippingMethod)
    {
        $this->view()->load('Admin.ShippingMethods.Items.Create', [
            'form' => $this->shippingMethodItemsService->getForms('/admin/shipping-methods/items/store', $shippingMethod)
        ], 'admin');
    }

    public function store(): void
    {
        if (!$this->shippingMethodItemsService->storeOrUpdate()) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/shipping-methods/items/' . $this->request()->input('shipping_method_id'));
    }

    public function edit(ShippingMethod $shippingMethod, ShippingMethodItem $shippingMethodItem)
    {
        $this->view()->load('Admin.ShippingMethods.Items.Edit', [
            'form' => $this->shippingMethodItemsService->getForms("/admin/shipping-methods/items/{$shippingMethodItem->id}", $shippingMethod, $shippingMethodItem)
        ], 'admin');
    }

    public function update(ShippingMethodItem $shippingMethodItem)
    {
        if (!$this->shippingMethodItemsService->storeOrUpdate($shippingMethodItem)) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/shipping-methods/items/' . $this->request()->input('shipping_method_id'));
    }

    public function delete(ShippingMethod $shippingMethod, ShippingMethodItem $shippingMethodItem)
    {
        $this->shippingMethodItemsService->delete($shippingMethodItem);

        $this->redirect()->to('/admin/shipping-methods/items/' . $shippingMethod->id);
    }
}