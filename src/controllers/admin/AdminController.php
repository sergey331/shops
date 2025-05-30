<?php 
namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;


class AdminController extends BaseController 
{
    public function index()  
    {
        $this->view()->load('Admin.Index',[],'admin');
    }


}