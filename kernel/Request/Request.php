<?php

namespace Kernel\Request;


use Kernel\Request\interface\RequestInterface;

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

    public function get($name): null|string|array
    {
        return $this->get[$name] ?? null;
    }

    public function post($name): null|string|array
    {
        return $this->post[$name] ?? null;
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

    public function input($name): null|string|array
    {
        return  $this->get[$name] ?? $this->post[$name] ?? null;
    }

    public function getUri(): null|string
    {
       return strtok($_SERVER['REQUEST_URI'],'?') ?? null;
    }

    public function has($key): bool
    {
        return (
            (isset($this->get[$key]) && $this->get[$key] !== '') ||
            (isset($this->post[$key]) && $this->post[$key] !== '')
        );
    }

    public function getMethod(): null|string
    {
        return $_SERVER['REQUEST_METHOD'] ?? null;
    }

    public function file($name): null|array
    {
        return $this->files[$name] ?? null;
    }
    public function hasFile($name): bool
    {
        return isset($_FILES[$name]) && $_FILES[$name]['error'] !== UPLOAD_ERR_NO_FILE;
    }
}