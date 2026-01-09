<?php

namespace Kernel\Request\interface;

use Kernel\File\FileData;

interface RequestInterface
{
    public function get(string $name): string|array|null;

    public function post(string $name): string|array|null;

    public function input(string $name): string|array|null;
     public function all(): array;
    public function getUri(): ?string;
    public function getMethod(): ?string;
    public function file(string $name): FileData|array|null;
    public function hasFile(string $name): bool;
    public function has(string $name): bool;
}
