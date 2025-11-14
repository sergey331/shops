<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class PostCommentRules implements interface\RulesInterface
{

    public static function rules(): array
    {
        return [
            'comment' => 'required|min:5',
            'user_id' => 'required',
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}