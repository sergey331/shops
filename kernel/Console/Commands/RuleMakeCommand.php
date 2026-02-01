<?php

namespace Kernel\Console\Commands;

class RuleMakeCommand
{
    protected string $content = '';
    protected string $name = '';

    public function __construct($name)
    {
        $this->name = $name;
        $className = ucfirst($name);
        $this->content = <<<PHP
<?php
namespace Shop\\Shop\rules;

use Shop\\rules\\interface\\RulesInterface;

class {$className} implements RulesInterface
{
    public static function rules(): array
    {
        return [

        ];
    }

    public static function messages(): array
    {
        return  [

        ];
    }
}
PHP;
    }

    public function make(): void
    {
        if (!$this->name) {
            exit(1);
        }




        $filename = __DIR__ . "/../../../src/rules/$this->name.php";

        if (file_exists($filename)) {
            echo "Rule file already exists: $filename" . PHP_EOL;
            exit(1);
        }
        if (file_put_contents($filename, $this->content)) {
            echo "Rule created successfully: $filename" . PHP_EOL;
        } else {
            echo "Failed to write rule file!" . PHP_EOL;
            exit(1);
        }
    }
}