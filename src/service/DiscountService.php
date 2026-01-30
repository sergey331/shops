<?php
namespace Shop\service;

use Kernel\Form\Form;
use Kernel\Service\BaseService;
use Shop\model\Disacount;

class DiscountService extends BaseService
{
    public function getDiscountForm($url,?Disacount $discount = null)
    {
        $form = new Form($url,'POST');

        $form->setInput('name','Name',[
            'class' => 'form-control',
            'value' => $discount->name ?? ''
        ]);

        $form->setTextarea('description','Description',[
            'class' => 'form-control',
            'value' => $discount->description ?? ''
        ]);

        $form->setDate('started_at', "Start",[
            'class' => 'form-control',
            'value' => $discount->publication_date ?? ''
        ]);

        $form->setCheckbox('is_active','Active',[
            'class' => 'form-check-input',
            'checked' => (bool) $discount->is_active,
            'value' => 1
        ]);
        return $form;
    }
}