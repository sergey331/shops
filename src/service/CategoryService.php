<?php

namespace Shop\service;

use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Category;
use Shop\rules\CategoryRules;

class CategoryService
{

    public function getAllCategories()
    {
        return model('category')->whereNull(['category_id'])->get();
    }

    public function getCategories(Category $category)
    {
        return model('category')
            ->whereNull(['category_id'])
            ->whereNotEqual(['id' => $category->id])
            ->get();
    }

    public function store(): bool
    {
        $data = request()->all();

        $validator = Validator::make($data, CategoryRules::rules(), CategoryRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleAvatarUpload($data);
        $this->cleanCategoryId($data);

        model('category')->create($data);

        return true;
    }

    public function update(Category $category): bool
    {
        $data = request()->all();
        $validator = Validator::make($data, CategoryRules::rules(), CategoryRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleAvatarUpload($data);
        $this->cleanCategoryId($data);
        $category->update($data);
        return true;
    }

    public function delete(Category $category)
    {
        if ($category->avatar) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/uploads/category/');
            $file->delete($category->avatar);
        }
        $category->delete();
    }

    private function handleAvatarUpload(array $data): array
    {
        if (request()->hasFile('avatar')) {
            $uploader = new File();
            $uploader->setFile(request()->file('avatar'));
            $uploader->setPath(APP_PATH . '/public/uploads/category/');

            if ($uploader->upload()) {
                $data['avatar'] = $uploader->getName();
            }
        } else {
            if (isset($data['avatar'])) {
                unset($data['avatar']);
            }
        }

        return $data;
    }

    private function cleanCategoryId(array &$data): void
    {
        if (empty($data['category_id'])) {
            unset($data['category_id']);
        }
    }
}