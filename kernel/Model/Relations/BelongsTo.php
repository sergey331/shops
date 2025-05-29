<?php

namespace Kernel\Model\Relations;

use Kernel\Databases\Connection;
use Kernel\Model\Model;
use ReflectionClass;

class BelongsTo extends Connection
{
    protected Model $parent;
    protected $relatedClass;
    protected string $foreignKey;

    public function __construct(Model $parent, string $relatedClass)
    {
        parent::__construct();
        $this->parent = $parent;
        $this->relatedClass = new $relatedClass();
        $this->foreignKey = strtolower((new ReflectionClass($this->relatedClass))->getShortName()) . '_id';    }

    public function get()
    {
        $table = $this->relatedClass->getTableName();

        $query = "SELECT * FROM $table WHERE id = ?";

        $result = $this->query($query, [$this->parent->{$this->foreignKey}]);

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
