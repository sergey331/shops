<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class AboutRules implements RulesInterface
{

    public static function rules(): array
    {
        return [
            'content' => 'required|min:3',
            'media_path'      => 'nullable|image|mimes:jpeg,png,jpg,gif,mp4,mov,ogg,qt|max:2048',
            'media_type'        => 'nullable',
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}