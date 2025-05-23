<?php

namespace Kernel\Request;


class Request implements RequestInterface
{
    public function __construct(
        public array $get,
        public array $post,
        public array $files,
        public array $server,
    )
    {
    }

    public function get($name): string
    {
        return $this->get[$name] ?? '';
    }

    public function post($name): string
    {
        return $this->post[$name] ?? '';
    }

    public function all(): array
    {
        $data = array_map(function ($value) {
            return $value;
        }, $this->get);
        foreach ($this->post as $key => $value) {
            $data[$key] = $value;
        }
        foreach ($this->files as $key => $value) {
            $data[$key] = $value;
        }
        return $data;
    }

    public function input($name): string
    {
        return  $this->get[$name] ?? $this->post[$name] ?? '';
    }

    public function getUri(): string
    {
       return $_SERVER['REQUEST_URI'] ?? '';
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? '';
    }

    public function file($name): string|array
    {
        return $this->files[$name] ?? '';
    }
    public function hasFile($name): bool
    {
        return isset($_FILES[$name]) && $_FILES[$name]['error'] !== UPLOAD_ERR_NO_FILE;
    }
}