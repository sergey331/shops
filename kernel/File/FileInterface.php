<?php
namespace Kernel\File;

interface FileInterface 
{

    public function __construct();
    public function setPath($path);

    public function getPath();

    public function setFile($file);
    public function getFile();

    public function upload();

    public function getName();

    public function delete($file): bool;
    public function getError();
    
}