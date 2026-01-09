<?php
namespace Kernel\File;

use Kernel\File\interface\FileInterface;

class File implements FileInterface
{
    private $path;
    private $file;
    private $fileName;
    private $size;
    private $error = '';

    public function __construct()
    {
        $this->size = ini_get('upload_max_filesize');
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile(): mixed
    {
        return $this->file;
    }

    public function upload()
    {
        $file = $this->getFile();
        $path = $this->getPath();

        // Проверяем, что файл действительно загружен
        if (!$file instanceof FileData || !$file->isValid() || !is_uploaded_file($file->tmpName)) {
            $this->error = 'No file uploaded.';
            return false;
        }

        // Проверяем MIME тип
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file->tmpName);
        finfo_close($finfo);

        $allowedImageTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'image/bmp'
        ];

        $allowedVideoTypes = [
            'video/mp4',
            'video/quicktime',
            'video/x-msvideo',
            'video/x-matroska',
            'video/webm'
        ];

        if (!in_array($mime, array_merge($allowedImageTypes, $allowedVideoTypes))) {
            $this->error = 'Invalid file type. Only images and videos are allowed.';
            return false;
        }

        // Создаём директорию, если нет
        if (!is_dir($path) && !mkdir($path, 0777, true)) {
            $this->error = 'Failed to create upload directory.';
            return false;
        }

        $safeName = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($file->name));
        $targetPath = $path . $safeName;

        if (!move_uploaded_file($file->tmpName, $targetPath)) {
            $this->error = 'Failed to move uploaded file.';
            return false;
        }

        $this->fileName = $safeName;
        return true;
    }

    public function delete($file): bool
    {
        $path = $this->getPath() . $file;

        if (file_exists($path)) {
            unlink($path);
            return true;
        } else {
            $this->error = 'File not found.';
            return false;
        }
    }

    public function getName()
    {
        return $this->fileName;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getFileCategory()
    {
        $file = $this->getFile();

        if (!$file instanceof FileData || !$file->isValid() || !is_uploaded_file($file->tmpName)) {
            return null;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file->tmpName);
        finfo_close($finfo);

        if (str_starts_with($mime, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mime, 'video/')) {
            return 'video';
        }
    }
}
