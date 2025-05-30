<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Kernel\Validator\Validator;
use Shop\rules\RegisterRule;

class RegisterController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Register.Index');
    }

    public function register(): void
    {
        $validator = Validator::make(
            $this->request()->all(),
            RegisterRule::rules(),
            RegisterRule::messages()
        );

        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
        }

        if ($this->model('User')->create($this->request()->all())) {
            $this->redirect()->to('/');
        }
        
    }
}