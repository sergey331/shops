<?php 
namespace Shop\controllers;

use Kernel\Validator\Validator;
use Kernel\Controller\BaseController;


class AuthController extends BaseController 
{
    public function index()  
    {
        $this->view()->load('Login.Index');
    }

    public function login()  
    {

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
        $validator = Validator::make(
            $this->request()->all(),
             $rules,$messages
            );

        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
        }

        $email = $this->request()->input('email');
        $password = $this->request()->input('password');

        if (!$this->auth()->attempt($email, $password)) {
            $this->redirect()->back();
        }

        if ($this->auth()->isAdmin()) {
            $this->redirect()->to('/admin');
        }
        $this->redirect()->to('/');
    }

    public function logout()
    {
        $this->auth()->logout();
        $this->redirect()->to('/login');
    }
}