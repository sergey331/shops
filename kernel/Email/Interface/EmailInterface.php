<?php

namespace Kernel\Email\Interface;

interface EmailInterface
{
    public function send(string $to, string $subject, string $body): bool;
}