<?php

namespace Kernel\Model\Relations;

use Kernel\Databases\Connection;
use Kernel\Model\Model;
use ReflectionClass;

class HasOne extends Connection
{
    protected Model $parent;
    protected $relatedClass;
    protected string $foreignKey;

    public function __construct(Model $parent, string $relatedClass)
    {
        parent::__construct();
        $this->parent = $parent;
        $this->relatedClass = new $relatedClass();
        $this->foreignKey = strtolower((new ReflectionClass($parent))->getShortName()) . '_id';
    }

    public function create(array $attributes)
    {
        $attributes[$this->foreignKey] = $this->parent->id;
        $columns = implode(',', array_keys($attributes));
        $placeholders = implode(',', array_fill(0, count($attributes), '?'));
        $values = array_values($attributes);
        $table = $this->relatedClass->getTableName();
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        return $this->query($sql, $values);
    }

    public function update(array $attributes)
    {
        $where = " WHERE {$this->foreignKey}=?";
        $values = array_values($attributes);
        $table = $this->relatedClass->getTableName();
        $keys = array_keys($attributes);
        $fields = implode(', ', array_map(fn($field) => "$field=?", $keys));
        $values = array_merge($values, [$this->parent->id]);
        $sql = sprintf('UPDATE  %s SET %s  %s',$table,$fields,$where);
        return $this->query($sql, $values);
    }

    public function delete()
    {
        $where = " WHERE {$this->foreignKey}=?";

        $table = $this->relatedClass->getTableName();

        $sql =  sprintf('DELETE FROM  %s   %s',$table,$where);
        return $this->query($sql, [$this->parent->id]);
    }

    public function get()
    {
        $table = $this->relatedClass->getTableName();
        $query = "SELECT * FROM $table WHERE {$this->foreignKey} = ?";
        $result = $this->query($query, [$this->parent->id]);
        $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
        return !empty($rows) ? $this->fetchData($rows[0]) : null;
    }

    private function fetchData(array $row)
    {
        $model = new  $this->relatedClass();
        $model->setData($row);
        return $model;
    }
}
