<?php

namespace Shop\rules;

use Shop\rules\interface\RulesInterface;

class BookRules implements RulesInterface
{

    public static function rules(): array
    {
        return [
            'title'        => 'required',
            'slug' => 'required',
            'description' => 'required',
            'isbn' => 'required',
            'language_id' => 'required',
            'pages' => 'required',
            'price' => 'required',
            'stock' => 'nullable',
            'cover_image' => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
            'publisher_id' => 'required',
            'publication_date' => 'required',
            'images'      => 'nullable|array',
            'category_id'      => 'required|array',
            'author_id' => 'required|array',
            'tag_id' => 'required|array'
        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}