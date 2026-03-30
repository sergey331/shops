<?php

namespace Kernel\Email\Interface;

interface EmailHandlerInterface
{
    public function handle($itemId): void;
}