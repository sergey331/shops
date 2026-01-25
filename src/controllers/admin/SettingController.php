<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\Setting;
use Shop\service\SettingService;

class SettingController extends BaseController
{
    protected SettingService $settingService;
    public function __construct()
    {
        $this->settingService = new SettingService();
    }
    public function index()
    {

        $this->view()->load(
            'Admin.Setting.Index',
            [
                'data' => $this->settingService->getSettingData() 
            ], 
            'admin'
        );
    }

    public function edit(Setting $setting) 
    {
         $this->view()->load(
            'Admin.Setting.Edit',
            [
                'forms' => $this->settingService->getForm($setting) 
            ], 
            'admin'
        );
    }

    public function save(Setting $setting) 
    {
        if (!$this->settingService->save($setting)) {
            $this->redirect()->back();
            return;
        }

        $this->redirect()->to('/admin/setting');
    }

    
}