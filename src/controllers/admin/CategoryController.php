<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Category;
use Shop\rules\CategoryRules;

class CategoryController extends BaseController
{
    public function index(): void
    {
        $this->view()->load('Admin.Category.Index', [
            'categories' => $this->model('category')->whereNull(['category_id'])->get(),
        ], 'admin');
    }

    public function create(): void
    {
        $categories = $this->model('category')->whereNull(['category_id'])->get();

        $this->view()->load('Admin.Category.Create', [
            'categories' => $categories,
        ], 'admin');
    }

    public function store(): void
    {
        $data = $this->request()->all();

        $validator = Validator::make($data, CategoryRules::rules(), CategoryRules::messages());

        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }

        $data = $this->handleAvatarUpload($data);
        $this->cleanCategoryId($data);

        $this->model('category')->create($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/categories');
    }

    public function edit(Category $category) 
    {
        $categories = $this->model('category')
            ->whereNull(['category_id'])
            ->whereNotEqual(['id' => $category->id])
            ->get();

        $this->view()->load('Admin.Category.Edit', [
            'category' => $category, 
            'categories' => $categories,
        ], 'admin');
     }

     public function update(Category $category)
     {
        
        $data = $this->request()->all();
        $validator = Validator::make($data, CategoryRules::rules(), CategoryRules::messages());

        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }

        $data = $this->handleAvatarUpload($data);
        $this->cleanCategoryId($data);
        $category->update($data);
        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/categories');
     }

     public function delete(Category $category)
     {
        if ($category->avatar) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/uploads/category/');
            $file->delete($category->avatar);
        }
         $category->delete();

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/categories');
     }

    private function handleAvatarUpload(array $data): array
    {
        if ($this->request()->hasFile('avatar')) {
            $uploader = new File();
            $uploader->setFile($this->request()->file('avatar'));
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
