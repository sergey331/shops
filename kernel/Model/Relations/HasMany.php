<?php

namespace Kernel\Model\Relations;

use Kernel\Model\Model;
use ReflectionClass;

class HasMany extends Relation
{
    protected Model $parent;
    protected mixed $relatedClass;
    protected string $foreignKey;

    public function __construct(Model $parent, string $relatedClass)
    {
        parent::__construct($parent,$relatedClass);
        $this->parent = $parent;
        $this->relatedClass = new $relatedClass();
        $this->foreignKey = strtolower((new ReflectionClass($parent))->getShortName()) . '_id';
    }

    public function get()
    {
        $this->where([$this->foreignKey => $this->parent->id]);
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getSelectQuery($this->relatedClass->getTableName(), $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());
        return $this->fetchArrayData($result->fetchAll(\PDO::FETCH_ASSOC));
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
