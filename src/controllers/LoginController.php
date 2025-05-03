<?php 
namespace Shop\controllers;

use Kernel\Controller\BaseController;


class LoginController extends BaseController 
{
    public function index()  
    {
        $this->view()->load('Login.Index');
    }

    public function login()  
    {

    }
}