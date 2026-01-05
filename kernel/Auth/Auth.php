<?php

namespace Kernel\Auth;

use Exception;
use Kernel\Auth\interface\AuthInterface;
use Kernel\Hash\Hash;

class Auth implements AuthInterface
{
    /**
     * Attempt to login user
     */
    public function attempt(string $email, string $password, bool $remember): bool
    {
        $model = $this->getModelName();
        $usernameField = $this->getUserName();

        $user = model($model)->where([$usernameField => $email])->first();

        if (!$user) {
            session()->set($this->error_key(), 'Email is incorrect');
            return false;
        }

        if (!Hash::verify($password, $user->password)) {
            session()->set($this->error_key(), 'Password is incorrect');
            return false;
        }

        // Store session
        session()->set($this->session_key(), $user->id);

        // Remember me
        if ($remember) {
            $this->setRememberToken($user->id);
        }

        session()->set('login_success', 'Login successfully');
        return true;
    }

    /**
     * Check authentication (session OR remember token)
     */
    public function check(): bool
    {
        if (session()->has($this->session_key())) {
            return true;
        }

        if (cookie()->has('remember_token')) {
            return $this->loginViaRememberToken();
        }

        return false;
    }

    /**
     * Get authenticated user ID
     */
    public function id(): ?int
    {
        return session()->get($this->session_key());
    }

    /**
     * Get authenticated user model
     */
    public function user()
    {
        if (!$this->check()) {
            return null;
        }

        return model($this->getModelName())->find($this->id());
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        $user = $this->user();
        return $user ? (bool)$user->is_admin : false;
    }

    /**
     * Logout user
     */
    public function logout(): void
    {
        if ($this->check()) {
            model($this->getModelName())
                ->where(['id' => $this->id()])
                ->update(['remember_token' => null]);
        }

        session()->remove($this->session_key());
        cookie()->remove('remember_token');
    }

    /* ==========================================================
       REMEMBER TOKEN LOGIC
       ========================================================== */

    /**
     * Create and store remember token
     */
    private function setRememberToken(int $userId): void
    {
        $token = bin2hex(random_bytes(32));
        $hashedToken = hash('sha256', $token);

        model($this->getModelName())
            ->where(['id' => $userId])
            ->update(['remember_token' => $hashedToken]);

        cookie()->set(
            'remember_token',
            $token,
            30 * 24 * 3600, // 30 days
            '/',
            '',
            true,  // secure
            true   // httponly
        );
    }

    /**
     * Restore session using remember token
     */
    private function loginViaRememberToken(): bool
    {
        $token = cookie()->get('remember_token');
        if (!$token) {
            return false;
        }

        $user = model($this->getModelName())
            ->where(['remember_token' => hash('sha256', $token)])
            ->first();

        if (!$user) {
            cookie()->remove('remember_token');
            return false;
        }

        session()->set($this->session_key(), $user->id);
        return true;
    }

    /* ==========================================================
       CONFIG HELPERS
       ========================================================== */

    private function getModelName(): string
    {
        return config('auth.model', 'user');
    }

    private function getUserName(): string
    {
        return config('auth.user_name', 'email');
    }

    private function session_key(): string
    {
        return config('auth.session_key', 'user_id');
    }

    private function error_key(): string
    {
        return config('auth.error_key', 'login_error');
    }
}
