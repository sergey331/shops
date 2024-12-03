<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category = $this->route('category');
        return [
            'name' => 'required|string|max:255',  // Category name is required
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category->id ?? null),
            ],
            'parent_id' => 'nullable|exists:categories,id',  // Optional parent category (must exist in categories table)
            'image' => 'nullable|image|mimes:jpg,jpeg,png',  // Optional image validation
        ];
    }
}
