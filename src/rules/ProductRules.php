<?php

namespace Shop\rules;

class ProductRules implements interface\RulesInterface
{

    public static function rules(): array
    {
        return  [
            "name" => "required|string|max:255",
            "description" => "required|string|max:255",
            "sku" => "required|string|max:255",
            "price" => "required|decimal",
            "quantity" => "required|integer",
            "status" => "required",
            "category_id" => "required|integer",
            "brand_id" => "required|integer",
            "image_url" => "nullable|image|mimes:jpeg,png,jpg,gif,svg",
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}