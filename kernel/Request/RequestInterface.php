<?php

namespace Kernel\Request;

interface RequestInterface
{
    public function get($name): string;
    public function post($name): string;
    public function all(): array;
    public function input($name): string;
    public function getUri(): string;
    public function getMethod(): string;
    public function file($name): string|array;
    public function hasFile($name): bool;
}