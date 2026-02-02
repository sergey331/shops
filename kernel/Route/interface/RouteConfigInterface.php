<?php

namespace Kernel\Route\interface;

interface RouteConfigInterface
{
    public function getMethod(): string;

    public function getAction(): array;

    public function getUri(): string;

    public function getGroup(): array;

    public function getParams(): array;
}