<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class DiscountRules implements interface\RulesInterface
{

    public static function rules(): array
    {
        return [
            'price'             => 'required|integer',
            'started_at'        => 'required|after',
            'finished_at'       => 'nullable|after:started_at',
            'type'              => 'required'
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}