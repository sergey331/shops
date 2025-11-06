<?php 

namespace Kernel\Auth;

use Exception;
use Kernel\Auth\interface\AuthInterface;
use Kernel\Hash\Hash;

class Auth implements AuthInterface
{
    public function __construct()
    {   
    }

    /**
     * @throws Exception
     */
    public function attempt(string $email, string $password): bool
    {
        $model_name = $this->getModelName();
        $user_name = $this->getUserName();
        $user = model($model_name)->where([$user_name => $email])->first();

        $error_key = $this->error_key();
        if (!$user) {
            session()->set($error_key,"Email is incorrect");
            return false;
        }

        if (!Hash::verify($password, $user->password)) {
            session()->set($error_key,"Password is incorrect");
            return  false;
        }

        $session_key = $this->session_key();
        session()->set($session_key, $user->id);
        session()->set('login_success',"Login successfully");
        return true;
    }

    public function isAdmin()
    {
        return $this->user()->is_admin;
    }

    public function check() 
    {
        $session_key = $this->session_key();
        return session()->has($session_key);
    }

    public function id() 
    {
        $session_key = $this->session_key();
        return session()->get($session_key);
    }

    public function user() 
    {
        if (!$this->check())
            return null;

        $user_model = $this->getModelName();
        return model($user_model)->find($this->id());
    }

    public function logout(): void
    {
        $session_key = $this->session_key();
        session()->remove($session_key);
    }

    private function  getModelName()
    {
        return config('auth.model','user');
    }

    private function getUserName()
    {
        return config('auth.user_name','email');
    }

    private function session_key()
    {
        return config('auth.session_key','user_id');
    }
    private function error_key()
    {
        return config('auth.error_key','login_error');
    }

}