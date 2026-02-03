<?php

namespace Kernel\Route;

use Kernel\Route\interface\RouteConfigInterface;

class RouteConfig implements RouteConfigInterface
{
    public function __construct(
        private string $method = '',
        private string $uri = '',
        private array  $action = [],
        private array  $params = [],
        private array  $group =  []
    )
    {
    }
    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction(): array
    {
        return $this->action;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getGroup(): array
    {
        return $this->group;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}