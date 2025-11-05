<?php

namespace Kernel\Console\Commands;

class MigrationMakeCommand
{
    protected string $content = '';
    protected string $name = '';

    public function __construct($name)
    {
        $this->name = $name;
        $className = ucfirst($name);        $this->content = <<<PHP
<?php

namespace Migration;

use Kernel\Migration\Table;
use Kernel\Migration\MigrationsInterface;

class {$className} implements MigrationsInterface
{
    public static function up(Table \$table): void
    {
        // Your migration logic here
    }

    public static function down(Table \$table): void
    {
        // Your rollback logic here
    }
}
PHP;
    }

    public function make()
    {
        if (!$this->name) {
            echo "Usage: php migration.php make <MigrationName>" . PHP_EOL;
            exit(1);
        }
        $timestamp = date('Y-m-d H-i-s');
        $filename = __DIR__ . "/../../../migration/{$timestamp}_" . lcfirst($this->name) . ".php";

        if (file_exists($filename)) {
            echo "Migration file already exists: $filename" . PHP_EOL;
            exit(1);
        }
        $result = file_put_contents($filename, $this->content);
        if ($result === false) {
            echo "Failed to write migration file!" . PHP_EOL;
            exit(1);
        } else {
            echo "Migration created successfully: $filename" . PHP_EOL;
        }

    }
}