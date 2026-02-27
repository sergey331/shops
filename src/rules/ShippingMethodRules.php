<?php
namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class ShippingMethodRules implements RulesInterface
{
    public static function rules(): array
    {
        return [
            'code' => 'required',
            'name' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}