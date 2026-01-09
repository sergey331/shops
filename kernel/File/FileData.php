<?php
namespace Kernel\File;

class FileData
{
    public function __construct(
        public string $name,
        public string $fullPath,
        public string $type,
        public string $tmpName,
        private int $error,
        public int $size
    ) {}

    public function isValid(): bool
    {
        return $this->error === UPLOAD_ERR_OK;
    }
}
