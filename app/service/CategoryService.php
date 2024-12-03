<?php

namespace App\service;

use App\Models\Category;

class CategoryService
{
    public function getCategories(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Category::query()
            ->with('parent')
            ->paginate(10);
    }
    public function getParentCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return  Category::query()->whereNull('parent_id')->get();
    }

    public function store($data)
    {
        Category::create($data);
    }

    public function update(Category $category, $data)
    {
        $category->update($data);
    }
}
