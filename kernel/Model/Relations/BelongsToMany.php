<?php

namespace Kernel\Model\Relations;

use Kernel\Model\Model;
use ReflectionClass;

class BelongsToMany extends Relation
{
    protected Model $model;

    protected mixed $relatedClass;
    protected string $relatedTable;

    protected string $foreignKey;
    protected string $relatedKey;

    public function __construct(Model $parent, string $relatedClass, string $relatedTable)
    {
        parent::__construct($parent, $relatedClass);

        $this->parent = $parent;
        $this->relatedClass = new $relatedClass();
        $this->relatedTable =  $relatedTable;
        $this->foreignKey = strtolower((new ReflectionClass($this->relatedClass))->getShortName()) . '_id';
        $this->relatedKey = strtolower((new ReflectionClass($parent))->getShortName()) . '_id';
    }

    public function get()
    {
        $data = $this->getParentData();
        return array_map(fn($row) => $this->fetch($row),$data);
    }

    private function fetch($row)
    {
        $this->modelWhere->clearWhere();
        $this->where(['id' => $row[$this->foreignKey]]);
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getSelectQuery($this->relatedClass->getTableName(), $this->modelWhere->getWhereQuery());
        $result = $this->query($query, [1]);
        return $this->fetchArrayData($result->fetchAll(\PDO::FETCH_ASSOC));
    }

    private function getParentData()
    {
        $this->modelWhere->clearWhere();
        $this->where([$this->relatedKey => $this->parent->id]);
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getSelectQuery($this->relatedTable, $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function fetchArrayData(array $data): array
    {
        return array_map(fn($row) => $this->fetchData($row), $data);
    }

    private function fetchData(array $row)
    {
        $model = new  $this->relatedClass();
        $model->setData($row);
        return $model;
    }
}