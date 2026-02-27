<?php
namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class ShippingMethodItemRules implements RulesInterface
{
    public static function rules(): array
    {
        return [
            'price' => 'required',
            'min_price' => 'required',
            'shipping_method_id' => 'required',
            'max_price' => 'nullable'
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}