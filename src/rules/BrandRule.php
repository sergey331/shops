<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class BrandRule implements RulesInterface
{

    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 255 characters.',
        ];
    }
}