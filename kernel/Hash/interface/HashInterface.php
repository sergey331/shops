<?php

namespace Kernel\Hash\interface;

interface HashInterface
{
    /**
     * Hash a plain password using bcrypt.
     */
    public static function make(string $password): string;

    /**
     * Verify that a plain password matches the given hash.
     */
    public static function verify(string $password, string $hash): bool;

    /**
     * Check if a hash needs to be rehashed (e.g., if the cost changes).
     */
    public static function needsRehash(string $hash): bool;
}