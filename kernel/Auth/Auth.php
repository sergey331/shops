<?php 

namespace Kernel\Auth;

use Kernel\Container\Container;

class Auth 
{
    public function __construct(private readonly Container $container)
    {   
    }
    public function attempt(string $email, string $password): bool 
    {
        $user = $this->model()->where(["email" => $email])->first();

        if (!$user) {
            $this->session()->set('login_error',"'Email is incorrect'");
            return false;
        }

        if (!password_verify($password, $user->password)) {
            $this->session()->set('login_error',"'Password is incorrect'");
            return  false;
        }

        $this->session()->set('user_id', $user->id);
        $this->session()->set('login_success',"'Password is incorrect'");
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
        return $this->session()->get('user_id');
    }

    public function user() 
    {
        if (!$this->check())
            return null;

        return $this->model()->find($this->id());
    }

    public function logout(): void
    {
        $this->session()->remove('user_id');
    }
    
    private function model()
    {
        return $this->container->get('db')->model("user");
    }

    private function session()
    {
        return $this->container->get("session");
    }
}