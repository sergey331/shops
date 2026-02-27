<?php

namespace Shop\service;

use Kernel\Form\Form;
use Kernel\Service\BaseService;
use Kernel\Table\Table;
use Kernel\Validator\Validator;
use Shop\model\ShippingMethod;
use Shop\rules\ShippingMethodRules;

class ShippingMethodService extends BaseService
{
    public function getShippingMethods(): array
    {
        $data = model('ShippingMethod')->paginate();
        return ['tableData' => $this->getTableData($data), 'shippingMethods' => $data];
    }

    public function getForms($url, ?ShippingMethod $shippingMethod = null)
    {

        $errors = session()->getCLean('errors') ?? [];
        $form = new Form($url, 'POST', ['enctype' => 'multipart/form-data'], $errors);

        $form->setInput('code', 'Code', [
            'class' => 'form-control',
            'value' => $shippingMethod->code ?? ''
        ]);
        $form->setInput('name', 'Name', [
            'class' => 'form-control',
            'value' => $shippingMethod->name ?? ''
        ]);

        $form->setFile('icon', 'Icon', [
            'class' => 'form-control',
        ]);
        $form->setCheckbox('enabled', 'Enabled', [
            'class' => 'form-check-input',
            'checked' => (bool)($shippingMethod->enabled ?? false),
            'value' => 1
        ]);
        return $form;
    }

    public function storeOrUpdate(?ShippingMethod $shippingMethod = null)
    {
        $data = request()->all();

        $validator = Validator::make($data, ShippingMethodRules::rules());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload("icon", APP_PATH . '/public/uploads/shippingMethods', $data);

        $shippingMethod
            ? $shippingMethod->update($data)
            : model('ShippingMethod')->create($data);
        session()->set('success', 'created');
        return true;
    }

    public function delete(ShippingMethod $shippingMethod)
    {
        if ($shippingMethod->icon) {
            $this->deleteImage($shippingMethod->icon,APP_PATH . '/public/uploads/shippingMethods');
        }
        $shippingMethod->delete();
        session()->set('success', 'deleted');
        return true;
    }

    private function getTableData($shippingMethods): Table
    {
        $table = new Table($shippingMethods->data, [
            "#" => ['field' => 'id'],
            "Code" => ['field' => 'code'],
            "Name" => ['field' => 'name'],
            "Icon" => ['field' => 'icon', 'data' => ['type' => 'image', 'path' => "/uploads/shippingMethods"]],
            "Actions" => [
                'callback' => function ($row) {
                    $id = $row->id;
                    return '
                        <a href="/admin/shipping-methods/items/' . $id . '" class="btn btn-sm btn-primary text-white">Items</a>
                        <a href="/admin/shipping-methods/' . $id . '" class="btn btn-sm btn-primary text-white">Edit</a>
                        <a href="/admin/shipping-methods/delete/' . $id . '" class="btn btn-sm btn-danger text-white">Delete</a>
                    ';
                }
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}