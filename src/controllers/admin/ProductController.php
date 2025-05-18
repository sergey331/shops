<?php

namespace Shop\controllers\admin;

use Kernel\File\File;
use Kernel\Validator\Validator;
use Kernel\Controller\BaseController;
use Shop\model\Product;
use Shop\rules\ProductRules;

class ProductController extends BaseController
{
    public function index()
    {
        $this->view()->load('Admin.Product.Index', [
            'products' => $this->model('product')->with(['category'])->get(),
        ], 'admin');
    }

    public function create()
    {

        $categories = $this->model('category')->get();

        $this->view()->load('Admin.Product.Create', [
            'categories' => $categories,
        ], 'admin');
    }

    public function store()
    {
        $data = $this->request()->all();
        $validator = Validator::make($data, ProductRules::rules(), ProductRules::messages());
        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }

        $data = $this->handleAvatarUpload($data);

        $this->model('product')->create($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/products');
    }

    public function edit(Product $product)
    {
        $categories = $this->model('category')->get();
        $this->view()->load('Admin.Product.Edit', [
            'categories' => $categories,
            'product' => $product
        ], 'admin');
    }
    public function update(Product $product)
    {
        $data = $this->request()->all();
        $validator = Validator::make($data, ProductRules::rules(), ProductRules::messages());
        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }

        $data = $this->handleAvatarUpload($data);

        $product->update($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/products');
    }

    public function delete(Product $product)
    {
        if ($product->avatar) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/uploads/product/');
            $file->delete($product->avatar);
        }
         $product->delete();

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/products');
    }

    private function handleAvatarUpload(array $data): array
    {
        if ($this->request()->hasFile('avatar')) {
            $uploader = new File();
            $uploader->setFile($this->request()->file('avatar'));
            $uploader->setPath(APP_PATH . '/public/uploads/product/');

            if ($uploader->upload()) {
                $data['avatar'] = $uploader->getName();
            }
        }

        return $data;
    }
}