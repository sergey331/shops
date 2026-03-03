<?php
namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class GeoZoneRules implements RulesInterface
{
    public static function rules(): array
    {
        return [
            'region_id' => 'required',
            'shipping_method_id' => 'required',
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}