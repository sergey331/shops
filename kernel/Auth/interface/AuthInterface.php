<?php

namespace Kernel\Auth\interface;

interface AuthInterface
{
    public function attempt(string $email, string $password): bool;

    public function isAdmin();

    public function check();

    public function id();

    public function user();

    public function logout(): void;
}
