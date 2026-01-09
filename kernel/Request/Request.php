<?php

namespace Kernel\Request;

use Kernel\Request\interface\RequestInterface;
use Kernel\File\FileData;

class Request implements RequestInterface
{
    public function __construct(
        public array $get = [],
        public array $post = [],
        public array $files = [],
        public array $server = []
    ) {}

    /* ==========================
       BASIC INPUT METHODS
    ========================== */

    public function get(string $name): string|array|null
    {
        return $this->get[$name] ?? null;
    }

    public function post(string $name): string|array|null
    {
        return $this->post[$name] ?? null;
    }

    public function input(string $name): string|array|null
    {
        return $this->get[$name]
            ?? $this->post[$name]
            ?? null;
    }

    public function has(string $key): bool
    {
        return (
            (isset($this->get[$key]) && $this->get[$key] !== '') ||
            (isset($this->post[$key]) && $this->post[$key] !== '')
        );
    }

    public function all(): array
    {
        $data = $this->get + $this->post; // combine GET + POST

        foreach ($this->files as $key => $file) {
            $data[$key] = $this->file($key); // converts to FileData or array of FileData
        }

        return $data;
    }


    /* ==========================
       REQUEST INFO
    ========================== */

    public function getUri(): ?string
    {
        return isset($this->server['REQUEST_URI'])
            ? strtok($this->server['REQUEST_URI'], '?')
            : null;
    }

    public function getMethod(): ?string
    {
        return $this->server['REQUEST_METHOD'] ?? null;
    }

    /* ==========================
       FILE HANDLING
    ========================== */

    public function hasFile(string $name): bool
    {
        if (!isset($this->files[$name])) {
            return false;
        }

        $files = $this->normalizeFiles($this->files[$name]);

        foreach ($files as $file) {
            if ($file['error'] !== UPLOAD_ERR_NO_FILE) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns:
     * - FileData (single file)
     * - FileData[] (multiple files)
     * - null (no file)
     */
    public function file(string $name): FileData|array|null
    {
        if (!isset($this->files[$name])) {
            return null;
        }

        $files = $this->normalizeFiles($this->files[$name]);

        $fileObjects = array_map(
            fn ($file) => new FileData(
                $file['name'],
                $file['full_path'] ?? '',
                $file['type'],
                $file['tmp_name'],
                $file['error'],
                $file['size']
            ),
            $files
        );

        return count($fileObjects) === 1
            ? $fileObjects[0]
            : $fileObjects;
    }

    /**
     * Always returns an array of FileData
     */
    public function files(string $name): array
    {
        $result = $this->file($name);

        return $result instanceof FileData
            ? [$result]
            : ($result ?? []);
    }

    /* ==========================
       INTERNAL HELPERS
    ========================== */

    /**
     * Normalize PHP $_FILES structure
     */
    private function normalizeFiles(array $file): array
    {
        // Single file
        if (!is_array($file['name'])) {
            return [$file];
        }

        $normalized = [];

        foreach ($file['name'] as $index => $name) {
            $normalized[] = [
                'name'       => $name,
                'full_path' => $file['full_path'][$index] ?? '',
                'type'       => $file['type'][$index],
                'tmp_name'   => $file['tmp_name'][$index],
                'error'      => $file['error'][$index],
                'size'       => $file['size'][$index],
            ];
        }

        return $normalized;
    }
}
