<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\Brand;
use Shop\service\BrandService;

class BrandController extends BaseController
{

    private BrandService $brandService;

    public function __construct()
    {
        $this->brandService = new BrandService();
    }
    public function index()
    {
        $this->view()->load('Admin.Brand.Index', [
            'brands' => $this->brandService->getBrands(),
        ], 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.Brand.Create', [], 'admin');
    }

    public function store()
    {
        if (!$this->brandService->store()) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/brand');
    }

    public function edit(Brand $brand): void
    {
        $this->view()->load('Admin.Brand.Edit', [
            'brand' => $brand
        ], 'admin');
    }
    public function update(Brand $brand): void
    {
        if (!$this->brandService->update($brand)) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/brand');
    }

    public function delete(Brand $brand)
    {
         $brand->delete();

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/brand');
    }
}