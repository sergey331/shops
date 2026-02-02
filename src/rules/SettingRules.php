<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class SettingRules implements RulesInterface
{

    public static function rules(): array
    {
        return [
            'email'         => 'required|email',
            'phone'         => 'required|phone',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address'       => 'required',
            'default_discount_days' => 'required|integer'
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}