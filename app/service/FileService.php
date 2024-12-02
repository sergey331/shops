<?php

namespace App\service;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function upload($file, $path)
    {
        $file_extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $file_extension;
        $file->storeAs($path, $filename,'public');
        return $filename;

    }
}
