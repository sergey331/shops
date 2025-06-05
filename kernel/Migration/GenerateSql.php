<?php

namespace Kernel\Migration;

class GenerateSql
{
    protected string $sql = '';

    protected string $tableName = '';
    protected array $fields = [];
    protected array $droppedFields = [];

    public function __construct(string $tableName, array $fields, array $droppedFields)
    {
        $this->tableName = $tableName;
        $this->fields = $fields;

    }

    public function generateCreateTableSql(): string
    {
        $this->sql = "CREATE TABLE IF NOT EXISTS `{$this->tableName}` (\n";

        $fieldDefinitions = [];

        foreach ($this->fields as $field) {
            $name     = $field['name'];
            $type     = $field['type'];
            $length   = $this->normalizeLength($type, $field['length']);
            $nullable = $field['nullable'] ? 'NULL' : 'NOT NULL';
            $default = '';
            if ($field['default'] !== null) {
                $upper = strtoupper($field['default']);
                $isSqlFunction = in_array($upper, ['CURRENT_TIMESTAMP', 'NOW()']);

                $default = $isSqlFunction
                    ? "DEFAULT {$field['default']}"
                    : "DEFAULT '{$field['default']}'";
            }
            $autoInc  = !empty($field['autoIncrement']) ? 'AUTO_INCREMENT' : '';
            $primary  = !empty($field['primary']) ? 'PRIMARY KEY' : '';
            $onUpdate = !empty($field['onUpdate']) ? "ON UPDATE {$field['onUpdate']}" : '';
            $fieldDef = "`$name` $type$length $nullable $default $autoInc $primary $onUpdate";
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

    public function generateAlterTableSql(): array
    {
        $sqlStatements = [];

        foreach ($this->fields as $field) {
            if (!empty($field['drop']) && $field['drop'] === true) {
                $sqlStatements[] = "ALTER TABLE `{$this->tableName}` DROP COLUMN `{$field['name']}`";
                continue;
            }

            $name     = $field['name'];
            $type     = $field['type'];
            $length   = $this->normalizeLength($type, $field['length']);
            $nullable = $field['nullable'] ? 'NULL' : 'NOT NULL';
            $default  = $field['default'] !== null ? "DEFAULT '{$field['default']}'" : '';
            $autoInc  = !empty($field['autoIncrement']) ? 'AUTO_INCREMENT' : '';
            $primary  = !empty($field['primary']) ? 'PRIMARY KEY' : '';


            $definition = "`$name` $type$length $nullable $default $autoInc $primary";
            $sqlStatements[] = "ALTER TABLE `{$this->tableName}` ADD COLUMN $definition";

            if (!empty($field['relation'])) {
                $relation = $field['relation'];
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


        return $sqlStatements;
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