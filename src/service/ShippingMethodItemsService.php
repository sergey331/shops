<?php

namespace Shop\service;

use Kernel\Form\Form;
use Kernel\Service\BaseService;
use Kernel\Table\Table;
use Kernel\Validator\Validator;
use Shop\model\ShippingMethod;
use Shop\model\ShippingMethodItem;
use Shop\rules\ShippingMethodItemRules;
use Shop\rules\ShippingMethodRules;

class ShippingMethodItemsService extends BaseService
{
    public function getShippingMethodItems($shippingMethod): array
    {
        $data = $shippingMethod->items()->paginate();
        return ['tableData' => $this->getTableData($data), 'shippingMethodItems' => $data];
    }

    public function getForms($url, ShippingMethod $shippingMethod, ?ShippingMethodItem $shippingMethodItem = null)
    {

        $errors = session()->getCLean('errors') ?? [];
        $form = new Form($url, 'POST', [], $errors);
        $form->setHidden('shipping_method_id','Shipping', [
            'value' => $shippingMethod->id
        ]);
        $form->setNumber('price', 'Price', [
            'class' => 'form-control',
            'value' => $shippingMethodItem->price ?? ''
        ]);
        $form->setNumber('min_price', 'Min price', [
            'class' => 'form-control',
            'value' => $shippingMethodItem->min_price ?? ''
        ]);
        $form->setNumber('max_price', 'Max price', [
            'class' => 'form-control',
            'value' => $shippingMethodItem->max_price ?? ''
        ]);
        return $form;
    }

    public function storeOrUpdate(?ShippingMethodItem $shippingMethodItem = null)
    {
        $data = request()->all();

        $validator = Validator::make($data, ShippingMethodItemRules::rules());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $shippingMethodItem
            ? $shippingMethodItem->update($data)
            : model('ShippingMethodItem')->create($data);
        session()->set('success', 'created');
        return true;
    }

    public function delete(ShippingMethodItem $shippingMethodItem)
    {
        $shippingMethodItem->delete();
        session()->set('success', 'deleted');
        return true;
    }

    private function getTableData($shippingMethodItems): Table
    {
        $table = new Table($shippingMethodItems->data, [
            "#" => ['field' => 'id'],
            "Price" => ['field' => 'price'],
            "Min price" => ['field' => 'min_price'],
            "Max price" => ['field' => 'max_price'],
            "Actions" => [
                'callback' => function ($row) {
                    $id = $row->id;
                    $shippingId = $row->shipping_method_id;
                    return '
                        <a href="/admin/shipping-methods/items/' . $shippingId .  '/' . $id . '" class="btn btn-sm btn-primary text-white">Edit</a>
                        <a href="/admin/shipping-methods/items/delete/' . $shippingId .  '/' . $id . '" class="btn btn-sm btn-danger text-white">Delete</a>
                    ';
                }
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}