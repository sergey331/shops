<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\Category;
use Shop\model\News;
use Shop\model\Slider;
use Shop\service\CategoryService;
use Shop\service\NewsService;
use Shop\service\SlidersService;

class CategoryController extends BaseController
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }
    public function index(): void
    {
        $data = $this->categoryService->getCategories();
        $this->view()->load('Admin.Category.Index', [
            'categories' => $data['categories'],
            'tableData' => $data['tableData']
        ], 'admin');
    }

    public function create(): void
    {

        $this->view()->load('Admin.Category.Create', [], 'admin');
    }

    public function store(): void
    {
        if (!$this->categoryService->store()) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/categories');
    }

    public function edit(Category $category)
    {
        $this->view()->load('Admin.Category.Edit', [
            'category' => $category
        ], 'admin');
    }

    public function update(Category $category)
    {
        if (!$this->categoryService->update($category)) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/categories');
    }

    public function delete(Category $category)
    {
        $this->categoryService->delete($category);

        $this->redirect()->to('/admin/categories');
    }
}
