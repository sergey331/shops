<?php 
namespace Kernel\Response\interface;

interface ResponseInterface
{
    public function json($data = [], int $status = 200): void;

    public function success(
        string $message = 'Success',
        array $data = [],
        int $status = 200
    ): void;

    public function error(
        string $message = 'Error',
        int $status = 400,
        array $errors = []
    ): void;
}