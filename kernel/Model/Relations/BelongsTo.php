<?php

namespace Kernel\Model\Relations;

use Kernel\Model\Model;
use ReflectionClass;

class BelongsTo extends Relation
{
    protected Model $parent;
    protected mixed $relatedClass;
    protected string $foreignKey;

    public function __construct(Model $parent, string $relatedClass)
    {
        parent::__construct($parent,$relatedClass);
        $this->parent = $parent;
        $this->relatedClass = new $relatedClass();
        $this->foreignKey = strtolower((new ReflectionClass($this->relatedClass))->getShortName()) . '_id';
    }

    public function get()
    {
        $this->where(["id" => $this->parent->{$this->foreignKey}]);
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getSelectQuery($this->relatedClass->getTableName(), $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());
        $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
        return !empty($rows) ? $this->fetchData($rows[0]) : null;
    }

    private function fetchData(array $row)
    {
        $model = new  $this->relatedClass();
        $model->setData($row);
        return $model;
    }

    public function getQueryBuilder()
    {
        return $this->modelWhere;
    }

    public function getRelatedTable()
    {
        return $this->relatedClass;
    }

    public function getForeignKey(): string
    {
        return $this->foreignKey;
    }

    public function getLocalKey(): ?string
    {
        return 'id';
    }

}
