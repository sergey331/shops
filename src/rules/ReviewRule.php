<?php
namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class ReviewRule implements RulesInterface
{
    public static function rules(): array
    {
        return [
            'rating' => 'required',
            'comment' => 'required'
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}