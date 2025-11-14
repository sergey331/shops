<?php

namespace Kernel\Validator\interface;

interface ValidatorInterface
{
    public function __construct(array $data, array $rules, array $messages = []);

    public static function make(array $data, array $rules, array $messages = []): ValidatorInterface;

    public function validate(): bool;
    public function errors(): array;
}
