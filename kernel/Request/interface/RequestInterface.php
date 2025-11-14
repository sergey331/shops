<?php

namespace Kernel\Request\interface;

interface RequestInterface
{
    public function get($name): null|string|array;
    public function post($name): null|string|array;
    public function all(): array;
    public function input($name): null|string|array;
    public function getUri(): null|string;
    public function getMethod(): null|string;
    public function file($name): null|array;
    public function hasFile($name): bool;
    public function has($name): bool;
}