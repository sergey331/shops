<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\Validator\Validator;
use Shop\model\Brand;
use Shop\model\Option;
use Shop\rules\BrandRule;
use Shop\rules\OptionRule;

class OptionController extends BaseController
{
    public function index()
    {
        $this->view()->load('Admin.Option.Index', [
            'options' => $this->model('option')->get(),
        ], 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.Option.Create', [], 'admin');
    }

    public function store()
    {
        $data = $this->request()->all();
        $validator = Validator::make($data, OptionRule::rules(), OptionRule::messages());
        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }
        $data['price'] = $data['price'] !== '' ? $data['price'] : null;
        $this->model('option')->create($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/option');
    }

    public function edit(Option $option)
    {
        $this->view()->load('Admin.Option.Edit', [
            'option' => $option
        ], 'admin');
    }
    public function update(Option $option)
    {
        $data = $this->request()->all();
        $validator = Validator::make($data, OptionRule::rules(), OptionRule::messages());
        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }
        $data['price'] = $data['price'] !== '' ? $data['price'] : null;
        $option->update($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/option');
    }

    public function delete(Option $option)
    {
         $option->delete();

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/option');
    }
}