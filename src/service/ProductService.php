<?php

namespace Shop\service;

use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Product;
use Shop\rules\ProductRules;

class ProductService
{
    public function getProducts()
    {
        return model('product')->with(['discount', 'options', 'images', 'category','brand'])->get();
    }

    public function getCategories()
    {
        return model('category')->get();
    }
    public function getBrands()
    {
        return model('brand')->get();
    }
    public function getOptions()
    {
        return model('option')->get();
    }

    public function store()
    {
        $data = request()->all();
        $validator = Validator::make($data, ProductRules::rules(), ProductRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleAvatarUpload($data);

        $product = model('product')->create([
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
            $product->discount()->create($data['discount']);
        }
        if (!empty($data['options'])) {
            foreach ($data['options'] as $option) {
                $product->options()->create([
                    'option_id' => $option,
                ]);
            }
        }

        $this->saveImages($data, $product);
        return true;
    }

    public function update(Product $product)
    {
        $data = request()->all();
        $validator = Validator::make($data, ProductRules::rules(), ProductRules::messages());
        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
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
            if ($product->discount()->get()) {
                $product->discount()->update($data['discount']);
            } else {
                $product->discount()->create($data['discount']);
            }
        }

        $product->options()->delete();
        foreach ($data['options'] as $option) {
            $product->options()->create([
                'option_id' => $option,
            ]);
        }
        $this->saveImages($data, $product);

        return true;
    }

    public function delete(Product $product)
    {
        if ($product->avatar) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/uploads/product/');
            $file->delete($product->avatar);
        }
        $product->delete();

    }


    private function handleAvatarUpload(array $data): array
    {
        if (request()->file('image_url')['name']) {
            $uploader = new File();
            $uploader->setFile(request()->file('image_url'));
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
                $product->images()->create([
                    'url' => $this->handleImageUpload($file),
                    'is_main' => 0
                ]);
            }
        }
    }

}