<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Category;
use Shop\rules\CategoryRules;
use Shop\service\CategoryService;

class CategoryController extends BaseController
{

    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }
    public function index(): void
    {
        $this->view()->load('Admin.Category.Index', [
            'categories' => $this->categoryService->getAllCategories(),
        ], 'admin');
    }

    public function create(): void
    {
        $this->view()->load('Admin.Category.Create', [
            'categories' => $this->categoryService->getAllCategories(),
        ], 'admin');
    }

    public function store(): void
    {
        if (!$this->categoryService->store()) {
            $this->redirect()->back();
            return;
        }
        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/categories');
    }

    public function edit(Category $category) 
    {
        $this->view()->load('Admin.Category.Edit', [
            'category' => $category, 
            'categories' => $this->categoryService->getCategories($category),
        ], 'admin');
     }

     public function update(Category $category)
     {
        if (!$this->categoryService->update($category)) {
            $this->redirect()->back();
            return;
        }
        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/categories');
     }

     public function delete(Category $category)
     {
        $this->categoryService->delete($category);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/categories');
     }
}
