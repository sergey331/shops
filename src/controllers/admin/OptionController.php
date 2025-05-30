<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\Validator\Validator;
use Shop\model\Option;
use Shop\rules\OptionRule;
use Shop\service\OptionService;

class OptionController extends BaseController
{
    private OptionService $optionService;

    public function __construct()
    {
        $this->optionService = new OptionService();
    }
    public function index()
    {
        $this->view()->load('Admin.Option.Index', [
            'options' => $this->optionService->getNews(),
        ], 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.Option.Create', [], 'admin');
    }

    public function store()
    {
        if (!$this->optionService->store()) {
            $this->redirect()->back();
            return;
        }
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
        if (!$this->optionService->update($option)) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/option');
    }

    public function delete(Option $option)
    {
         $option->delete();

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/option');
    }
}