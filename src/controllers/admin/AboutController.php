<?php

namespace Shop\controllers\admin;

use Exception;
use Kernel\Controller\BaseController;
use Shop\model\News;
use Shop\model\Slider;
use Shop\service\AboutService;
use Shop\service\NewsService;
use Shop\service\SlidersService;

class AboutController extends BaseController
{
    private AboutService $aboutService;

    public function __construct()
    {
        $this->aboutService = new AboutService();
    }

    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Admin.About.Modify', [
            'about' => $this->aboutService->getAbout(),
        ], 'admin');
    }

    /**
     * @throws Exception
     */
    public function modify(): void
    {
        if (!$this->aboutService->modify()) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/about');
    }
}
