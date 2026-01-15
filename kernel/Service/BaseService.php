<?php 
namespace Kernel\Service;

use Kernel\File\File;
use Kernel\File\FileData;
use Kernel\Model\interface\ModelInterface;

class BaseService {
   public function handleImageUpload(string|FileData $image, string $path, array $data = []): array|string
{
    $file = null;
    $key  = null;

    if ($image instanceof FileData) {
        $file = $image;
    } elseif (request()->hasFile($image)) {
        $file = request()->file($image);
        $key  = $image;
    }

    if (!$file) {
        if (is_string($image)) {
            unset($data[$image]);
        }
        return $data;
    }

    $uploader = new File();
    $uploader->setFile($file);
    $uploader->setPath($path);

    if ($uploader->upload()) {
        if ($key !== null) {
            $data[$key] = $uploader->getName();
        } else {
            $data = $uploader->getName();
        }
    }

    return $data;
}


    public function deleteImage($key,$path)
    {
            $file = new File();
            $file->setPath($path);
            $file->delete($key);
    }
}