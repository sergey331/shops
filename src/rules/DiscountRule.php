<?php
namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class DiscountRule implements RulesInterface
{
    public static function rules(): array
    {
        return [
            'name' => 'required',
            'value' => 'required|integer',
            'min_order_amount' => 'nullable|integer',
            'started_at' => 'required|after',
            'finished_at' => 'nullable|after:started_at',
            'type' => 'required'
        ];
    }

    public static function messages(): array
    {
        return [

        ];
    }
}