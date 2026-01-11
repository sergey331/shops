<?php 
namespace Kernel\Service;

use Kernel\File\File;
use Kernel\Model\interface\ModelInterface;

class BaseService {
    public function handleImageUpload(string $image_key,string $path, array $data): array
    {

        if (request()->hasFile($image_key)) {
            $uploader = new File();
            $uploader->setFile(request()->file($image_key));
            $uploader->setPath($path);

            if ($uploader->upload()) {
                $data[$image_key] = $uploader->getName();
            }
        } else {
            if (isset($data[$image_key])) {
                unset($data[$image_key]);
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