<?php
namespace Shop\service;

use InvalidArgumentException;
use Kernel\Service\BaseService;

class EmailService extends BaseService
{
    private array $handlers;

    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    public function send(string $type, $itemId = null): void
    {
        if (!isset($this->handlers[$type])) {
            throw new InvalidArgumentException("Email type [$type] not supported");
        }
        $this->handlers[$type]->handle($itemId);
    }
}