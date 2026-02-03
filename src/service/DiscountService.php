<?php
namespace Shop\service;

use Kernel\Form\Form;
use Kernel\Table\Table;
use Shop\model\Discount;
use Shop\model\DiscountTarget;
use Shop\rules\DiscountRule;
use Kernel\Service\BaseService;
use Kernel\Validator\Validator;

class DiscountService extends BaseService
{


    public function getDiscountsData()
    {
        $discounts = model('Discount')->paginate();
        return [
            'discounts' => $discounts,
            'tableData' => $this->getTableData($discounts)
        ];
    }

    public function getDiscounts()
    {
        return model('discount')
            ->where(['is_active' => true])
            ->whereOp('started_at', '<=', date('Y-m-d'))
            ->get();
    }

    public function storeOrUpdate(?Discount $discount = null)
    {
        $data = request()->all();
       
        $validator = Validator::make($data,DiscountRule::rules());

        if (!$validator->validate()) {
            session()->set('errors',$validator->errors());
            return false;
        }

        if ($data['min_order_amount'] === '') {
            unset($data['min_order_amount']);
        }

        if ($data['finished_at'] === '') {
            $daysToAdd = setting()->default_discount_days ?? 30;
            $data['finished_at'] = date("Y-m-d",strtotime($data['started_at'] . " + $daysToAdd days" ));
        }

        $data['is_active'] = !empty($data['is_active']) ? 1 : 0;

        if ($discount) {
            $discount->update($data);
        } else {
            model('Discount')->create($data);
        }

        return true;
    }

    public function delete(Discount $discount): true
    {
        $discount->delete();
        return true;
    }



    public function getDiscountForm($url, ?Discount $discount = null)
    {
        $errors = session()->getCLean('errors') ?? [];
        $form = new Form($url, 'POST',errors: $errors);

        $form->setInput('name', 'Name', [
            'class' => 'form-control',
            'value' => $discount->name ?? ''
        ]);
        $form->setTextarea('description', 'Description', [
            'class' => 'form-control',
            'value' => $discount->description ?? ''
        ]);

        $form->setSelect('type', 'Type',
        Discount::TYPES, [
            'class' => 'form-control',
            'value' => $discount->type ?? ''
        ]);

        $form->setNumber('min_order_amount', 'Min order amount', [
            'class' => 'form-control',
            'value' => $discount->min_order_amount ?? ''
        ]);

        $form->setNumber('value', 'Value', [
            'class' => 'form-control',
            'value' => $discount->value ?? ''
        ]);

        $form->setDate('started_at', "Start", [
            'class' => 'form-control',
            'value' => $discount->started_at ?? ''
        ]);

        $form->setDate('finished_at', "Finish", [
            'class' => 'form-control',
            'value' => $discount->finished_at ?? ''
        ]);

        $form->setCheckbox('is_active', 'Active', [
            'class' => 'form-check-input',
            'checked' => (bool) ($discount->is_active ?? false),
            'value' => 1
        ]);
        return $form;
    }
    private function getTableData($discounts)
    {
        $table = new Table($discounts->data, [
            "#" => ['field' => 'id'],
            "Name" => ['field' => 'name'],
            "Description" => ['field' => 'description'],
            "Type" => ['field' => 'type'],
            "Value" => ['field' => 'value'],
            "Min order amount" => ['field' => 'min_order_amount'],
            "Started at" => ['field' => 'started_at'],
            'Finished at' => ['field' => 'finished_at'],
            "Actions" => [
                'callback' => function ($row) {
                    $id = $row->id;
                    return '
                        <div class="d-flex gap-1">
                            <a href="/admin/discounts/edit/' . $id . '" class="btn btn-sm btn-primary text-white">Edit</a>
                            <form action="/admin/discounts/delete/' . $id . '" method="POST"> 
                                <button type="submit"  class="btn btn-sm btn-danger">Delete</button>
                            </form> 
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