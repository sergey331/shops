<?php

namespace Shop\service;

use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Brand;
use Shop\rules\BrandRule;

class BrandService
{
    public function getBrands()
    {
        return model('brand')->get();
    }

    public function store()
    {
        $data = request()->all();
        $validator = Validator::make($data, BrandRule::rules(), BrandRule::messages());
        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload($data);
        model('brand')->create($data);
        session()->set('success', 'created');
        return true;
    }

    public function update(Brand $brand)
    {
        $data = request()->all();
        $validator = Validator::make($data, BrandRule::rules(), BrandRule::messages());
        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }
        $data = $this->handleImageUpload($data);
        $brand->update($data);

        session()->set('success', 'update');
        return true;
    }

    public function delete(Brand $brand)
    {
        if ($brand->image_url) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/uploads/brands/');
            $file->delete($brand->image_url);
        }
        $brand->delete();
        return true;
    }

    private function handleImageUpload(array $data): array
    {

        if (request()->hasFile('image_url')) {
            $uploader = new File();
            $uploader->setFile(request()->file('image_url'));
            $uploader->setPath(APP_PATH . '/public/uploads/brands/');

            if ($uploader->upload()) {
                $data['image_url'] = $uploader->getName();
            }
        } else {
            if (isset($data['image_url'])) {
                unset($data['image_url']);
            }
        }
        return $data;
    }
}