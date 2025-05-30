<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Product;
use Shop\model\ProductDiscount;
use Shop\rules\ProductRules;
use Shop\service\ProductService;

class ProductController extends BaseController
{
    private  ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }
    public function index()
    {
        $this->view()->load('Admin.Product.Index', [
            'products' => $this->productService->getProducts(),
        ], 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.Product.Create', [
            'categories' => $this->productService->getCategories(),
            'statuses' => Product::$status,
            'brands' => $this->productService->getBrands(),
            'options' => $this->productService->getOptions(),
            'discountTypes' => ProductDiscount::$types,
        ], 'admin');
    }

    public function store()
    {
        if (!$this->productService->store()) {
            $this->redirect()->back();
            return;
        }

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/products');
    }

    public function edit(Product $product)
    {
        $product = $product->with(['discount', 'options', 'images', 'category', 'brand']);
        $this->view()->load('Admin.Product.Edit', [
            'product' => $product,
            'categories' => $this->productService->getCategories(),
            'statuses' => Product::$status,
            'brands' => $this->productService->getBrands(),
            'options' => $this->productService->getOptions(),
            'discountTypes' => ProductDiscount::$types,
        ], 'admin');
    }
    public function update(Product $product)
    {
        if (!$this->productService->update($product)) {
            $this->redirect()->back();
            return;
        }

        $this->session()->set('success', 'updated');
        $this->redirect()->to('/admin/products');
    }

    public function delete(Product $product)
    {
        $this->productService->delete($product);
        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/products');
    }
}