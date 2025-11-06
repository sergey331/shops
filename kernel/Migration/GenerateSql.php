<?php

namespace Kernel\Migration;

use Kernel\Migration\interface\GenerateSqlInterface;

class GenerateSql implements GenerateSqlInterface
{
    protected string $sql = '';

    protected string $tableName = '';
    protected array $fields = [];

    private string $host;
    private mixed $user;
    private mixed $pass;
    private mixed $dbName;

    private  Database $database;
    protected array $droppedFields = [];
    protected array $droppedRelations = [];

    public function __construct(string $tableName, array $fields, array $droppedFields, array $dropRelations = [])
    {
        $this->tableName = $tableName;
        $this->fields = $fields;
        $this->host = env('DB_HOST', 'localhost');
        $this->user = env('DB_USERNAME', 'root');
        $this->pass = env('DB_PASSWORD', '');
        $this->dbName = env('DB_DATABASE', '');
        $this->droppedFields = $droppedFields;
        $this->droppedRelations = $dropRelations;
        $this->database = new Database();
    }

    public function generateCreateTableSql(): string
    {
        $this->sql = "CREATE TABLE IF NOT EXISTS `{$this->tableName}` (\n";

        $fieldDefinitions = [];

        foreach ($this->fields as $field) {
            $name = $field['name'];
            $type = $field['type'];
            $length = $this->normalizeLength($type, $field['length']);
            $nullable = $field['nullable'] ? 'NULL' : 'NOT NULL';
            $unique = $field['unique'] ? 'UNIQUE' : '';
            $default = '';
            if ($field['default'] !== null) {
                $upper = strtoupper($field['default']);
                $isSqlFunction = in_array($upper, ['CURRENT_TIMESTAMP', 'NOW()']);

                $default = $isSqlFunction
                    ? "DEFAULT {$field['default']}"
                    : "DEFAULT '{$field['default']}'";
            }
            $autoInc = !empty($field['autoIncrement']) ? 'AUTO_INCREMENT' : '';
            $primary = !empty($field['primary']) ? 'PRIMARY KEY' : '';
            $onUpdate = !empty($field['onUpdate']) ? "ON UPDATE {$field['onUpdate']}" : '';
            $fieldDef = "`$name` $type$length $nullable $unique $default $autoInc $primary $onUpdate";
            $fieldDefinitions[] = trim($fieldDef);


            if (!empty($field['relations'])) {
                $relation = $field['relations'];
                $fk = "FOREIGN KEY (`$name`) REFERENCES `{$relation['on']}`(`{$relation['references']}`)";
                if (!empty($relation['onDelete'])) {
                    $fk .= " ON DELETE {$relation['onDelete']}";
                }
                if (!empty($relation['onUpdate'])) {
                    $fk .= " ON UPDATE {$relation['onUpdate']}";
                }
                $fieldDefinitions[] = $fk;
            }
        }

        $this->sql .= implode(",\n", $fieldDefinitions) . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        return $this->sql;
    }

    public function generateAlterTableSql(): string
    {
        $sqlStatements = [];

        foreach ($this->droppedRelations as $field) {
            $sqlStatements[] = "ALTER TABLE `{$this->tableName}` DROP FOREIGN KEY `{$field}`";
        }

        foreach ($this->droppedFields as $field) {
            $sqlStatements[] = "ALTER TABLE `{$this->tableName}` DROP COLUMN `{$field}`";
        }

        foreach ($this->fields as $field) {
            $name = $field['name'];

            // Build column definition
            $type = $field['type'];
            $length = $this->normalizeLength($type, $field['length']);
            $nullable = !empty($field['nullable']) ? 'NULL' : 'NOT NULL';
            $default = isset($field['default']) ? "DEFAULT '{$field['default']}'" : '';
            $autoInc = !empty($field['autoIncrement']) ? 'AUTO_INCREMENT' : '';
            $primary = !empty($field['primary']) ? 'PRIMARY KEY' : '';
            $unique = $field['unique'] ? 'UNIQUE' : '';
            $definition = "`$name` $type$length $nullable $unique $default $autoInc $primary";
            $columnExists = $this->columnExists($this->tableName, $field['name']);

            // Determine ALTER action
            if (!empty($field['changed']) && is_string($field['changed'])) {
                $newName = $field['changed'];
                $sqlStatements[] = "ALTER TABLE `{$this->tableName}` CHANGE `$name` `$newName` $type$length $nullable $unique $default $autoInc $primary";
            } elseif ($columnExists) {
                $sqlStatements[] = "ALTER TABLE `{$this->tableName}` MODIFY COLUMN $definition";
            } else {
                $sqlStatements[] = "ALTER TABLE `{$this->tableName}` ADD COLUMN $definition";
            }


            if (!empty($field['relations'])) {
                $relation = $field['relations'];
                $fk = "ALTER TABLE `{$this->tableName}` ADD FOREIGN KEY (`$name`) " .
                    "REFERENCES `{$relation['on']}`(`{$relation['references']}`)";
                if (!empty($relation['onDelete'])) {
                    $fk .= " ON DELETE {$relation['onDelete']}";
                }
                if (!empty($relation['onUpdate'])) {
                    $fk .= " ON UPDATE {$relation['onUpdate']}";
                }
                $sqlStatements[] = $fk;
            }
        }
        return implode(";\n", $sqlStatements) . ";";
    }

    private function columnExists( string $table, string $column): bool
    {
        $pdo = $this->database->connectPDO($this->host, $this->user, $this->pass);
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = ?
              AND TABLE_NAME = ? 
              AND COLUMN_NAME = ?
        ");
        $stmt->execute([
            $this->dbName,
            $table,
            $column
        ]);
        return $stmt->fetchColumn() > 0;
    }

    private function normalizeLength(string $type, mixed $length): string
    {
        // If the type already includes parentheses, skip adding length
        if (str_contains($type, '(')) {
            return '';
        }

        if ($length === null) {
            return '';
        }

        if (is_array($length)) {
            if (in_array($type, ['decimal', 'double', 'float']) && count($length) === 2) {
                return "({$length[0]},{$length[1]})";
            }

            if (in_array($type, ['enum', 'set'])) {
                $escaped = array_map(fn($v) => "'" . addslashes($v) . "'", $length);
                return '(' . implode(',', $escaped) . ')';
            }

            // fallback for other types
            return '(' . implode(',', $length) . ')';
        }

        return "($length)";
    }
}