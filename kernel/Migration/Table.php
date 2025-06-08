<?php

namespace Kernel\Migration;

class Table
{
    private string $tableName = '';

    private Fields $fields;
    private string $sql;

    public function __construct()
    {
        $this->fields = new Fields();
    }

    public function createTable($name, $callback): void
    {
        $this->tableName = $name;
        $callback($this->fields);
        $generateSql = new GenerateSql($this->tableName, $this->fields->getFields(), $this->fields->getDroppedFields());
        $this->sql =  $generateSql->generateCreateTableSql();
    }

    public function updateAlterTable($name, $callback): void
    {
        $this->tableName = $name;
        $callback($this->fields);
        $generateSql = new GenerateSql($this->tableName, $this->fields->getFields(), $this->fields->getDroppedFields());
        $this->sql = $generateSql->generateAlterTableSql();
    }

    public function dropTable($name): void
    {
        $this->tableName = $name;
        $this->sql = "DROP TABLE IF EXISTS `{$this->tableName}`;";
    }

    public function getSql(): string
    {
        return $this->sql;
    }
}