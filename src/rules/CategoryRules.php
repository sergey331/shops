<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class CategoryRules implements interface\RulesInterface
{

    public static function rules(): array
    {
        return [
            'name'        => 'required',
            'description' => 'required|min:3',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}