<?php

namespace Kernel\Request\interface;

interface RequestInterface
{
    public function get($name): null|string;
    public function post($name): null|string;
    public function all(): array;
    public function input($name): null|string;
    public function getUri(): null|string;
    public function getMethod(): null|string;
    public function file($name): null|array;
    public function hasFile($name): bool;
}