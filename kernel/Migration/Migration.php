<?php

namespace Kernel\Migration;

use Exception;
use PDO;

class Migration
{
    private string $host;
    private string $user;
    private string $pass;
    private string $dbName;
    private string $migrationDir;
    private Database $db;

    public function __construct()
    {
        $this->host = env('DB_HOST', 'localhost');
        $this->user = env('DB_USERNAME', 'root');
        $this->pass = env('DB_PASSWORD', '');
        $this->dbName = env('DB_DATABASE', '');
        $this->migrationDir = __DIR__ . '/../../databases/migration';
        $this->db = new Database();
    }

    public function migrate(): void
    {
        $this->checkMigrationTable();

        $pdo = $this->db->connectPDO($this->host, $this->user, $this->pass, $this->dbName);

        if (!is_dir($this->migrationDir)) {
            $this->exitWithError("Migration directory not found: {$this->migrationDir}");
        }

        $exists = $pdo->prepare("SELECT name FROM migration");
        $exists->execute();
        $files = $this->getFiles();
        $filtered = array_diff($files, $exists->fetchAll(PDO::FETCH_COLUMN));
        if (empty($filtered)) {
            $this->log("✅ No new migrations to apply.");
            return;
        }
        foreach ($filtered as $file) {
            $filePath = "{$this->migrationDir}/{$file}";
            if (!is_file($filePath)) {
                continue;
            }

            require_once $filePath;

            $className = $this->getMigrationClassName($file);

            if (!class_exists($className)) {
                $this->log("❌ Class not found: {$className} in {$file}");
                continue;
            }

            if (!method_exists($className, 'up')) {
                $this->log("❌ Method up() not found in {$className}");
                continue;
            }

            $this->log("▶ Running migration: {$className}::up()");
            $table = new Table();
            $className::up($table);

            $pdo->exec($table->getSql());

            $insert = $pdo->prepare("INSERT INTO migration (name) VALUES (?)");
            $insert->execute([$file]);

            $this->log("✅ Migration applied: {$file}");
        }
    }

    public function resetMigration(int $steps): void
    {
        if ($steps <= 0 || empty($steps)) {
            $this->exitWithError("Invalid steps parameter. It should be a positive number.");
        }

        $pdo = $this->db->connectPDO($this->host, $this->user, $this->pass, $this->dbName);

        if (!is_dir($this->migrationDir)) {
            $this->exitWithError("Migration directory not found: {$this->migrationDir}");
        }
        $files = array_slice($this->getFiles(), -$steps);

        $this->drop($files,$pdo);
    }

    public function rollbackMigration(): void
    {

        $pdo = $this->db->connectPDO($this->host, $this->user, $this->pass, $this->dbName);

        if (!is_dir($this->migrationDir)) {
            $this->exitWithError("Migration directory not found: {$this->migrationDir}");
        }

        $files = array_reverse($this->getFiles());

        $this->drop($files,$pdo);
    }

    private function drop($files,$pdo): void
    {
        foreach ($files as $file) {
            $filePath = "{$this->migrationDir}/{$file}";
            if (!is_file($filePath)) {
                continue;
            }

            require_once $filePath;

            $className = $this->getMigrationClassName($file);

            if (!class_exists($className)) {
                $this->log("❌ Class not found: {$className} in {$file}");
                continue;
            }

            if (!method_exists($className, 'down')) {
                $this->log("❌ Method down() not found in {$className}");
                continue;
            }

            $exists = $pdo->prepare("SELECT 1 FROM migration WHERE name = ?");
            $exists->execute([$file]);

            if (!$exists->fetch()) {
                $this->log("⚠️ Migration not applied yet: {$file}");
                continue;
            }

            $this->log("⏪ Running migration: {$className}::down()");
            $table = new Table();
            $className::down($table);

            $pdo->exec($table->getSql());

            $delete = $pdo->prepare("DELETE FROM migration WHERE name = ?");
            $delete->execute([$file]);

            $this->log("✅ Migration reverted: {$file}");
        }
    }
    private function checkMigrationTable(): void
    {
        $initialSqlFile = "{$this->migrationDir}/database.sql";
        $pdo = $this->db->connectPDO($this->host, $this->user, $this->pass);

        if (!file_exists($initialSqlFile)) {
            throw new Exception("Initial SQL file not found: {$initialSqlFile}");
        }

        $sql = file_get_contents($initialSqlFile);
        $pdo->exec($sql);
    }

    private function getMigrationClassName(string $filename): string
    {
        [, $namePart] = explode('_', $filename, 2);
        $namePart = ucfirst(pathinfo($namePart, PATHINFO_FILENAME));
        return "Migration\\{$namePart}";
    }

    private function getFiles(): array
    {
        $files = array_filter(
            scandir($this->migrationDir),
            fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'php' && $file !== 'database.sql'
        );

        sort($files, SORT_NATURAL);
        return array_values($files);
    }

    private function log(string $message): void
    {
        echo $message . PHP_EOL;
    }

    private function exitWithError(string $message): void
    {
        echo "❌ {$message}" . PHP_EOL;
        exit(1);
    }
}
