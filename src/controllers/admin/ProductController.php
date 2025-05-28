<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Product;
use Shop\model\ProductDiscount;
use Shop\rules\ProductRules;

class ProductController extends BaseController
{
    public function index()
    {
        $this->view()->load('Admin.Product.Index', [
            'products' => $this->model('product')->with(['discount', 'options', 'images', 'category'])->get(),
        ], 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.Product.Create', [
            'categories' => $this->model('category')->get(),
            'statuses' => Product::$satatus,
            'brands' => $this->model('brand')->get(),
            'options' => $this->model('option')->get(),
            'discountTypes' => ProductDiscount::$types,
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

        $product = $this->model('product')->create([
            "name" => $data['name'],
            "description" => $data['description'],
            "sku" => $data['sku'],
            "price" => $data['price'],
            "quantity" => $data['quantity'],
            "status" => $data['status'],
            "category_id" => $data['category_id'],
            "brand_id" => $data['brand_id'],
            "image_url" => $data['image_url'],
        ]);

        if (isset($data['discount']) && !empty($data['discount']['discount_type'])) {
            $data['discount']['product_id'] = $product->id;
            $this->model('ProductDiscount')->create($data['discount']);
        }
        if (!empty($data['options'])) {
            foreach ($data['options'] as $option) {
                $this->model('ProductOption')->create([
                    'option_id' => $option,
                    'product_id' => $product->id,
                ]);
            }
        }

        $this->saveImages($data, $product);
    }

    public function edit(Product $product)
    {
        $categories = $this->model('category')->get();
        $this->view()->load('Admin.Product.Edit', [
            'categories' => $categories,
            'product' => $product,
            'statuses' => Product::$satatus,
            'brands' => $this->model('brand')->get(),
            'options' => $this->model('option')->get(),
            'discountTypes' => ProductDiscount::$types,
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
        $data['image_url'] = is_array($data['image_url']) ? $product->image_url : $data['image_url'];
        $product->update([
            "name" => $data['name'],
            "description" => $data['description'],
            "sku" => $data['sku'],
            "price" => $data['price'],
            "quantity" => $data['quantity'],
            "status" => $data['status'],
            "category_id" => $data['category_id'],
            "brand_id" => $data['brand_id'],
            "image_url" => $data['image_url'],
        ]);

        if (isset($data['discount']) && !empty($data['discount']['discount_type'])) {
            $data['discount']['product_id'] = $product->id;
            $this->model('ProductDiscount')->where(['product_id' => $product->id])->update($data['discount']);
        }
        $this->model('ProductOption')->where(['product_id' => $product->id])->delete();
        foreach ($data['options'] as $option) {
            $this->model('ProductOption')->create([
                'option_id' => $option,
                'product_id' => $product->id,
            ]);
        }
        $this->saveImages($data, $product);
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
        if ($this->request()->file('image_url')['name']) {
            $uploader = new File();
            $uploader->setFile($this->request()->file('image_url'));
            $uploader->setPath(APP_PATH . '/public/uploads/product/');

            if ($uploader->upload()) {
                $data['image_url'] = $uploader->getName();
            }
        }

        return $data;
    }

    private function handleImageUpload($image)
    {
        if (!isset($image['error']) || $image['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploader = new File();
            $uploader->setFile($image);
            $uploader->setPath(APP_PATH . '/public/uploads/product/images/');

            if ($uploader->upload()) {
                return $uploader->getName();
            }
        }

        return null;
    }

    private function saveImages($data, $product)
    {
        foreach ($data['images']['name'] as $index => $image) {
            if($image !== '') {
                $file = [
                    "name" => $data['images']['name'][$index],
                    "tmp_name" => $data['images']['tmp_name'][$index],
                    "error" => $data['images']['error'][$index],
                    "size" => $data['images']['size'][$index],
                ];
                $this->model('ProductImage')->create([
                    'url' => $this->handleImageUpload($file),
                    'product_id' => $product->id,
                    'is_main' => 0
                ]);
            }
        }


        $this->redirect()->to('/admin/products');
    }
}