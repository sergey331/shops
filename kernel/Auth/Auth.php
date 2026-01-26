<?php

namespace Kernel\Auth;

use Kernel\Auth\interface\AuthInterface;
use Kernel\Cart\Cart;
use Kernel\Cart\DbCartStorage;
use Kernel\Cart\SessionCartStorage;
use Kernel\Hash\Hash;

class Auth implements AuthInterface
{
    private ?object $cachedUser = null;

    /**
     * Attempt to login user
     */
    public function attempt(string $email, string $password, bool $remember = false): bool
    {
        $user = $this->findUserByUsername($email);

        if (!$user) {
            return $this->fail('Email is incorrect');
        }

        if (!Hash::verify($password, $user->password)) {
            return $this->fail('Password is incorrect');
        }

        $remember
            ? $this->setRememberToken($user->id)
            : session()->set($this->sessionKey(), $user->id);

        session()->set('login_success', 'Login successfully');

        return true;
    }

    /**
     * Check authentication (session OR remember token)
     */
    public function check(): bool
    {
        if (session()->has($this->sessionKey())) {
            return true;
        }

        return cookie()->has('remember_token') && $this->loginViaRememberToken();
    }

    /**
     * Get authenticated user ID
     */
    public function id(): ?int
    {
        return $this->check()
            ? session()->get($this->sessionKey())
            : null;
    }

    /**
     * Get authenticated user model
     */
    public function user(): ?object
    {
        if ($this->cachedUser !== null) {
            return $this->cachedUser;
        }

        $id = $this->id();
        if (!$id) {
            return null;
        }

        return $this->cachedUser = model($this->model())->find($id);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return (bool)($this->user()->is_admin ?? false);
    }

    /**
     * Logout user
     */
    public function logout(): void
    {
        if ($id = $this->id()) {
            model($this->model())
                ->where(['id' => $id])
                ->update(['remember_token' => null]);
        }

        session()->remove($this->sessionKey());
        cookie()->remove('remember_token');
        $this->cachedUser = null;
    }

    private function setRememberToken(int $userId): void
    {
        $token = bin2hex(random_bytes(32));

        model($this->model())
            ->where(['id' => $userId])
            ->update([
                'remember_token' => hash('sha256', $token)
            ]);

        cookie()->set(
            'remember_token',
            $token,
            $this->expireTime(),
            '/'
        );
    }

    private function loginViaRememberToken(): bool
    {
        $token = cookie()->get('remember_token');

        if (!$token) {
            return false;
        }

        $user = model($this->model())
            ->where(['remember_token' => hash('sha256', $token)])
            ->first();

        if (!$user) {
            cookie()->remove('remember_token');
            return false;
        }

        session()->set($this->sessionKey(), $user->id);
        $this->cachedUser = $user;

        return true;
    }

    private function findUserByUsername(string $value): ?object
    {
        return model($this->model())
            ->where([$this->usernameField() => $value])
            ->first();
    }

    private function fail(string $message): bool
    {
        session()->set($this->errorKey(), $message);
        return false;
    }

    private function model(): string
    {
        return config('auth.model', 'user');
    }

    private function usernameField(): string
    {
        return config('auth.user_name', 'email');
    }

    private function sessionKey(): string
    {
        return config('auth.session_key', 'user_id');
    }

    private function errorKey(): string
    {
        return config('auth.error_key', 'login_error');
    }

    private function expireTime(): int
    {
        return (int) config('auth.session_expire', 2592000);
    }

    public function setCart(): void
    {
        $sessionCart = new Cart(
            new SessionCartStorage()
        );

        $dbCart = new Cart(
            new DbCartStorage()
        );

        foreach ($sessionCart->get() as $item) {
            $dbCart->add($item->getBookId(), $item->getQty());
        }

        session()->remove('cart');
    }
}
