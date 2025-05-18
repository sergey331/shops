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
            'avatar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public static function messages(): array
    {
        return  [
            'name.required'        => 'Category name is required',
            'description.required' => 'Description is required',
            'avatar.image'         => 'Avatar must be an image',
            'avatar.mimes'         => 'Avatar must be a file of type: jpeg, png, jpg, gif',
            'avatar.max'           => 'Avatar must not exceed 2MB',
        ];
    }
}