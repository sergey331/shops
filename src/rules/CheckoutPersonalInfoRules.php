<?php
namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class CheckoutPersonalInfoRules implements RulesInterface
{
    public static function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'nullable',
            'phone' => 'required',
            'email' => 'required|email',
            'region_id' => 'required',
            'city' => 'required',
            'address' => 'required',
            'address1' => 'nullable',
            'zip' => 'required'
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}