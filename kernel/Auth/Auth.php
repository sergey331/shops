<?php 

namespace Kernel\Auth;

use Kernel\Container\Container;
use Kernel\Hash\Hash;

class Auth implements AuthInterface
{
    public function __construct()
    {   
    }
    public function attempt(string $email, string $password): bool 
    {
        $user = model("user")->where(["email" => $email])->first();

        if (!$user) {
            session()->set('login_error',"Email is incorrect");
            return false;
        }

        if (!Hash::verify($password, $user->password)) {
            session()->set('login_error',"Password is incorrect");
            return  false;
        }

        session()->set('user_id', $user->id);
        session()->set('login_success',"Login successfully");
        return true;
    }

    public function isAdmin()
    {
        return $this->user()->is_admin;
    }

    public function check() 
    {
        return session()->has('user_id');
    }

    public function id() 
    {
        return session()->get('user_id');
    }

    public function user() 
    {
        if (!$this->check())
            return null;

        return model("user")->find($this->id());
    }

    public function logout(): void
    {
        session()->remove('user_id');
    }
}