<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Kernel\Validator\Validator;

class RegisterController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Register.Index',['a' => "test"]);
    }

    public function register(): void
    {
        $rules = [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|max:30',
        ];
        $messages = [
            'username.required' => 'Username is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 20 characters long',
            'password.max' => 'Password must not exceed 30 characters',
        ];
        $validator = Validator::make(
            $this->request()->all(),
             $rules,$messages
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