<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class SliderRules implements interface\RulesInterface
{

    public static function rules(): array
    {
        return [
            'title'        => 'required',
            'content' => 'required|min:3',
            'image_url'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}