<?php
namespace Kernel\File;

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

    public function getFile():mixed   
    {
        return $this->file;
    }

    public function upload()
    {
        $file = $this->getFile();

        $path = $this->getPath();
    

        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                $this->error = 'Failed to create upload directory.';
                return false;
            }
        }
        $safeName = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($file['name']));
        $targetPath = $path . $safeName;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
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
}