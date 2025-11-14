<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class AuthRule implements interface\RulesInterface
{

    public static function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public static function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
    }
}