<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\News;
use Shop\model\Slider;
use Shop\service\NewsService;
use Shop\service\SlidersService;

class SlidersController extends BaseController
{
    private SlidersService $slidersService;

    public function __construct()
    {
        $this->slidersService = new SlidersService();
    }
    public function index(): void
    {
        $this->view()->load('Admin.Sliders.Index', [
            'sliders' => $this->slidersService->getSliders(),
        ], 'admin');
    }

    public function create(): void
    {

        $this->view()->load('Admin.Sliders.Create', [], 'admin');
    }

    public function store(): void
    {
        if (!$this->slidersService->store()) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/sliders');
    }

    public function edit(Slider $slider)
    {
        $this->view()->load('Admin.Sliders.Edit', [
            'slider' => $slider,
        ], 'admin');
    }

    public function update(Slider $slider)
    {
        if (!$this->slidersService->update($slider)) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/sliders');
    }

    public function delete(Slider $slider)
    {
        $this->slidersService->delete($slider);

        $this->redirect()->to('/admin/sliders');
    }
}
