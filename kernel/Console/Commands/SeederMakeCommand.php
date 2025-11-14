<?php

namespace Kernel\Console\Commands;

class SeederMakeCommand
{
    protected string $content = '';
    protected string $name = '';

    public function __construct($name)
    {

        if (!str_contains($name,"Seed")) {
            $name = $name."Seed";
        }
        $this->name = $name;
        $className = ucfirst($name);
        $this->content = <<<PHP
<?php
namespace Seeder;
use Kernel\Seeder\Seeder;

class {$className} extends Seeder
{
    public static function run(): void
    {
        // Your seeder logic here
    }
}
PHP;
    }

    public function make(): void
    {
        if (!$this->name) {
            echo "Usage: php migration.php make <MigrationName>" . PHP_EOL;
            exit(1);
        }




        $filename = __DIR__ . "/../../seeders/$this->name.php";

        if (file_exists($filename)) {
            echo "Seeder file already exists: $filename" . PHP_EOL;
            exit(1);
        }
        file_put_contents($filename, $this->content);
    }
}