<?php

namespace Kernel\Email\Drivers;

use Exception;
use InvalidArgumentException;

class EmailDriverFactory
{
    /**
     * @throws Exception
     */
    public static function make(string $driver)
    {
        return match ($driver) {
            'smtp' => new SmtpEmail(config('email.mailers')['smtp'] ?? []),
            default => throw new InvalidArgumentException("Driver [$driver] not supported"),
        };
    }
}