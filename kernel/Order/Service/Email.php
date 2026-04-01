<?php

namespace Kernel\Order\Service;

use Kernel\Email\Interface\EmailHandlerInterface;

class Email
{
    private EmailHandlerInterface $handler;

    public function __construct(EmailHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    public function send($itemId = null): void
    {
        $this->handler->handle($itemId);
    }
}