<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class RegisterRule implements RulesInterface
{

    public static function rules(): array
    {
        return  [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|max:30',
        ];
    }

    public static function messages(): array
    {
        return  [
            'username.required' => 'Username is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 20 characters long',
            'password.max' => 'Password must not exceed 30 characters',
        ];
    }
}