<?php
namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class DiscountRule implements RulesInterface
{
    public static function rules(): array
    {
        return [
            'name' => 'required',
            'value' => 'required|decimal',
            'min_order_amount' => 'nullable|decimal',
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