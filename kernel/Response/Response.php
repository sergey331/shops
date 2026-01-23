<?php

namespace Kernel\Response;

use Kernel\Response\interface\ResponseInterface;

class Response implements ResponseInterface
{
    public function json($data = [], int $status = 200): void
    {
        if (ob_get_length()) {
            ob_end_clean();
        }

        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');

        $json = json_encode(
            $data,
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );

        if ($json === false) {
            echo json_encode([
                'status' => false,
                'error' => json_last_error_msg()
            ]);
            exit;
        }

        echo $json;
        exit;
    }

    public function html($data = '', int $status = 200): void
    {
        if (ob_get_length()) {
            ob_end_clean();
        }

        http_response_code($status);
        header('Content-Type: text/html; charset=utf-8');

        if (is_array($data) || is_object($data)) {
            throw new \InvalidArgumentException(
                'HTML response expects string, array/object given'
            );
        }

        echo (string) $data;
        exit;
    }

    public function success(
        string $message = 'Success',
        array  $data = [],
        int    $status = 200
    ): void
    {
        $this->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public function error(
        string $message = 'Error',
        int    $status = 400,
        array  $errors = []
    ): void
    {
        $this->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $status);
    }
}