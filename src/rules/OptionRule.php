<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class OptionRule implements RulesInterface
{

    public static function rules(): array
    {
        return [
            'variant_name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'price' => 'nullable',
        ];
    }

    public static function messages(): array
    {
        return [
            'variant_name.required' => 'The name field is required.',
            'variant_name.string' => 'The name field must be a string.',
            'variant_name.max' => 'The name field must not exceed 255 characters.',
        ];
    }
}