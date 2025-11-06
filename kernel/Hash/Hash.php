<?php

namespace Kernel\Hash;

use Kernel\Hash\interface\HashInterface;

class Hash implements HashInterface
{
    /**
     * Hash a plain password using bcrypt.
     */
    public static function make(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verify that a plain password matches the given hash.
     */
    public static function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Check if a hash needs to be rehashed (e.g., if the cost changes).
     */
    public static function needsRehash(string $hash): bool
    {
        return password_needs_rehash($hash, PASSWORD_BCRYPT);
    }
}