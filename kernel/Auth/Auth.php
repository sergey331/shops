<?php 

namespace Kernel\Auth;

use Kernel\Container\Container;

class Auth 
{
    public function __construct(private Container $container)
    {   
    }
    public function attempt(string $email, string $password) 
    {
        $user = $this->model()->where(["email" => $email])->first();

        if (!$user) {
            $this->session()->set('login_error',"'Email is incorect'");
            return false;
        }

        if (!password_verify($password, $user->password)) {
            $this->session()->set('login_error',"'Password is incorect'");
            return  false;
        }

        $this->session()->set('user_id', $user->id);
        $this->session()->set('login_success',"'Password is incorect'");
        return true;
    }

    public function isAdmin()
    {
        return $this->user()->is_admin;
    }

    public function check() 
    {
        return $this->session()->has('user_id');
    }

    public function id() 
    {
        $this->session()->get('user_id');
    }

    public function user() 
    {
        if (!$this->check())
            return null;
        $id = $this->session()->get('user_id');

        return $this->model()->find($id);
    }

    public function logout() 
    {
        $this->session()->remove('user_id');
    }
    
    private function model()
    {
        return $this->container->get('db')->model("User");
    }

    private function session()
    {
        return $this->container->get("session");
    }
}