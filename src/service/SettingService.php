<?php
namespace Shop\service;

use Kernel\Form\Form;
use Kernel\Table\Table;
use Kernel\Validator\Validator;
use Shop\model\Setting;
use Kernel\Service\BaseService;
use Shop\rules\SettingRules;

class SettingService extends BaseService
{

    public function getSetting()
    {
        return model('setting')->first();
    }

    public function getSettingData()
    {
        return $this->getTableData(
            model('setting')->all()
        );
    }

    public function save(Setting $setting)
    {
        $data = request()->all();
        $validator = new Validator($data, SettingRules::rules());
        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $path = APP_PATH . '/public/uploads/setting';
        if (
            $setting &&
            request()->hasFile('logo') &&
            $setting->logo
        ) {
            $oldImage = $path . '/' . $setting->logo;
            if (file_exists($oldImage)) {     
                unlink($oldImage);
            }
        }

        $data = $this->handleImageUpload('logo', $path, $data);
        $setting->update($data);
        return true;
    }
    public function getForm(Setting $setting)
    {
        $errors = session()->getCLean('errors') ?? [];
        $form = new Form('/admin/setting/edit/' . $setting->id, 'POST', ['enctype' => 'multipart/form-data'], $errors);

        $form->setEmail('email', 'Email', [
            'class' => 'form-control',
            'value' => $setting->email ?? ''
        ]);

        $form->setInput('address', 'Address', [
            'class' => 'form-control',
            'value' => $setting->address ?? ''
        ]);

        $form->setInput('phone', 'Phone', [
            'class' => 'form-control',
            'value' => $setting->phone ?? ''
        ]);
        $form->setNumber('default_discount_days', 'Default discount days', [
            'class' => 'form-control',
            'value' => $setting->default_discount_days ?? ''
        ]);

        $form->setSelect('currency_id', 'Currency', model('Currency')->get(), [
            'class' => 'form-control',
            'option_default_label' => "Select Currency",
            'value' => $book->currency_id ?? ''
        ]);

        $form->setFile('logo', 'Logo', [
            'class' => 'form-control'
        ]);

        return $form;

    }

    private function getTableData($setting)
    {
        $table = new Table($setting, [
            "#" => ['field' => 'id'],
            "Email" => ['field' => 'email'],
            "Phone" => ['field' => 'phone'],
            "Address" => ['field' => 'address'],
            "Default discount days" => ['field' => 'default_discount_days'],
            "Currency" => ['field' => 'currency.name'],
            "Logo" => ['field' => 'logo', 'data' => ['type' => 'image', 'path' => "/uploads/setting"]],
            "Actions" => [
                'callback' => function ($row) {
                    $id = $row->id;
                    return '
                        <a href="/admin/setting/' . $id . '" class="btn btn-sm btn-primary text-white">Edit</a>
                    ';
                }
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}