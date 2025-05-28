<?php

namespace Shop\rules\interface;

interface RulesInterface
{
    public static function rules(): array;
    public static function messages(): array;
}