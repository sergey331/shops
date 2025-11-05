<?php

namespace Kernel\Model;

class ModelMakeCommand
{
    protected string $content = '';
    protected string $name = '';

    public function __construct($name)
    {
        $this->name = $name;
        $className = ucfirst($name);
        $this->content = <<<PHP
<?php
namespace Shop\\model;

use Kernel\\Model\\Model;

class {$className} extends Model
{
    protected string \$table = '';
    protected array \$fillable = [];
}
PHP;
    }

    public function make(): void
    {
        if (!$this->name) {
            exit(1);
        }




        $filename = __DIR__ . "/../../src/model/$this->name.php";

        if (file_exists($filename)) {
            echo "Model file already exists: $filename" . PHP_EOL;
            exit(1);
        }
        file_put_contents($filename, $this->content);
    }
}