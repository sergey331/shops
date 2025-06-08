<?php

namespace Kernel\Migration;

use Exception;
use PDO;

class Migration
{
    private string $host;
    private mixed $user;
    private mixed $pass;
    private mixed $dbName;
    private string $migrationDir;

    private Database $db;
    public function __construct()
    {
        $this->host = env('DB_HOST', 'localhost');
        $this->user = env('DB_USERNAME', 'root');
        $this->pass = env('DB_PASSWORD', '');
        $this->dbName = env('DB_DATABASE', '');
        $this->migrationDir = __DIR__  . '/../../migration';
        $this->db = new Database();
    }
    public function migrate()
    {
        $this->checkMigrationTable();
        $pdo = $this->db->connectPDO($this->host, $this->user, $this->pass, $this->dbName);

        if (!is_dir($this->migrationDir)) {
            echo "Migration directory not found: $this->migrationDir" . PHP_EOL;
            exit(1);
        }
        $files = $this->getFiles();
        foreach ($files as $file) {
            $filePath = "$this->migrationDir/$file";
            if (!is_file($filePath)) continue;

            require_once $filePath;

            $className = $this->getMigrationClassName($file);
            if (!class_exists($className)) {
                echo "Class not found: $className in $file" . PHP_EOL;
                continue;
            }

            if (!method_exists($className, 'up')) {
                echo "Static method up() not found in $className" . PHP_EOL;
                continue;
            }

            $checkMigration = $pdo->prepare("SELECT 1 FROM migration WHERE name = ?");
            $checkMigration->execute([$file]);

            if ($checkMigration->rowCount() > 0) {
                echo "Migration already applied: $file" . PHP_EOL;
                continue;
            }

            echo "Running migration: $className::up()" . PHP_EOL;
            $table = new \Kernel\Migration\Table();
            $className::up($table);

            $sql = $table->getSql();
            $pdo->exec($sql);

            $logMigration = $pdo->prepare("INSERT INTO migration (name) VALUES (?)");
            $logMigration->execute([$file]);

            echo "Migration applied: $file" . PHP_EOL;
        }
    }

    private function checkMigrationTable(): void
    {
        $initialSqlFile = "$this->migrationDir/database.sql";
        $pdo = $this->db->connectPDO($this->host, $this->user, $this->pass);

        if (!file_exists($initialSqlFile)) {
            throw new Exception("Initial SQL file not found: $initialSqlFile");
        }

        $sql = file_get_contents($initialSqlFile);
        $pdo->exec($sql);
        echo "Database '$this->dbName' prepared successfully." . PHP_EOL;
    }

    private function getMigrationClassName(string $filename): string
    {
        $parts = explode('_', $filename,2);
        $last = ucfirst(explode('.', array_pop($parts))[0]);
        return "Migration\\$last";
    }

    private function getFiles(): array
    {
        $files = array_filter(
            array_diff(scandir($this->migrationDir), ['.', '..', 'database.sql']),
            fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'php'
        );

        sort($files);
        return $files;
    }
}