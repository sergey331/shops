<?php

namespace Kernel\Console\Commands;

class MakeCommand
{
    protected string $content = '';
    protected string $name = '';
    public function __construct($name,$method)
    {
        $this->name = $name;
        $this->content = (new Content())->{$method}($name);
    }

    public function makeFile($filename)
    {
        if (!$this->name) {
            exit(1);
        }
        if (file_exists($filename)) {
            echo "File already exists: $filename" . PHP_EOL;
            exit(1);
        }
        $dir = dirname($filename);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (file_put_contents($filename, $this->content)) {
            return true;
        } else {
           return false;
        }
    }
}