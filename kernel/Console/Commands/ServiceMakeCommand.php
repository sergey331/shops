<?php

namespace Kernel\Console\Commands;

class ServiceMakeCommand
{
    protected string $content = '';
    protected string $name = '';

    public function __construct($name)
    {
        $this->name = $name;
        $className = ucfirst($name);
        $this->content = <<<PHP
<?php
namespace Shop\\service;

use Kernel\\Service\\BaseService;

class {$className} extends BaseService
{
    
}
PHP;
    }

    public function make(): void
    {
        if (!$this->name) {
            exit(1);
        }




        $filename = __DIR__ . "/../../../src/service/$this->name.php";

        if (file_exists($filename)) {
            echo "Service file already exists: $filename" . PHP_EOL;
            exit(1);
        }
        if (file_put_contents($filename, $this->content)) {
            echo "Service created successfully: $filename" . PHP_EOL;
        } else {
            echo "Failed to write model file!" . PHP_EOL;
            exit(1);
        }
    }
}