<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class PostUpdateRules implements interface\RulesInterface
{

    public static function rules(): array
    {
        return [
            'title'        => 'required',
            'content' => 'required|min:3',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'views' =>  'nullable|integer'
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}