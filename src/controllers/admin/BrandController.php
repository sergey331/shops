<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\Validator\Validator;
use Shop\model\Brand;
use Shop\rules\BrandRule;

class BrandController extends BaseController
{
    public function index()
    {
        $this->view()->load('Admin.Brand.Index', [
            'brands' => $this->model('brand')->get(),
        ], 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.Brand.Create', [], 'admin');
    }

    public function store()
    {
        $data = $this->request()->all();
        $validator = Validator::make($data, BrandRule::rules(), BrandRule::messages());
        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }

        $this->model('brand')->create($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/brand');
    }

    public function edit(Brand $brand)
    {
        $this->view()->load('Admin.Brand.Edit', [
            'brand' => $brand
        ], 'admin');
    }
    public function update(Brand $brand)
    {
        $data = $this->request()->all();
        $validator = Validator::make($data, BrandRule::rules(), BrandRule::messages());
        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }
        $brand->update($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/brand');
    }

    public function delete(Brand $brand)
    {
         $brand->delete();

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/brand');
    }
}