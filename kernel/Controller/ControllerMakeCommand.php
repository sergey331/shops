<?php

namespace Kernel\Controller;

class ControllerMakeCommand
{
    protected string $content = '';
    protected string $name = '';

    public function __construct($name)
    {

        if (!str_contains($name,"Controller")) {
            $name = $name."Controller";
        }
        $this->name = $name;

        $a = explode('/',$name);
        $className = ucfirst($a[1] ?? $a[0]);
        $namespace = isset($a[1])
            ? 'Shop\\controllers\\'.$a[0]
            : 'Shop\\controllers';

        $this->content = <<<PHP
<?php

namespace {$namespace};

use Kernel\Controller\BaseController;

class {$className} extends BaseController
{
    
}
PHP;
    }

    public function make(): void
    {
        if (!$this->name) {
            exit(1);
        }

        $filename = __DIR__ . "/../../src/controllers/$this->name.php";

        if (file_exists($filename)) {
            echo "Controller file already exists: $filename" . PHP_EOL;
            exit(1);
        }
        $dir = dirname($filename);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($filename, $this->content);
    }
}