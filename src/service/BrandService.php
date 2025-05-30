<?php

namespace Shop\service;

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
        $brand->update($data);

        session()->set('success', 'update');
        return true;
    }
}