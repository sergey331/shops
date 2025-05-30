<?php

namespace Kernel\Model\Relations;

use Kernel\Databases\Connection;
use Kernel\Model\Model;
use Kernel\Model\ModelWhere;
use Kernel\Model\QueryBuilder;
use Kernel\Model\Trait\ConditionsTrait;
use ReflectionClass;

class Relation extends Connection
{
    use ConditionsTrait;

    protected ModelWhere $modelWhere;
    protected QueryBuilder $queryBuilder;

    protected Model $parent;
    protected mixed $relatedClass;
    protected string $foreignKey;
    public function __construct(Model $parent, string $relatedClass)
    {
        parent::__construct();
        $this->modelWhere = new ModelWhere();
        $this->queryBuilder = new QueryBuilder();
        $this->parent = $parent;
        $this->relatedClass = new $relatedClass();
        $this->foreignKey = strtolower((new ReflectionClass($parent))->getShortName()) . '_id';
    }

    public function create(array $attributes): false|\PDOStatement|null
    {
        $attributes[$this->foreignKey] = $this->parent->id;
        $values = array_values($attributes);
        $query = $this->queryBuilder->getInsertQuery(
            $this->relatedClass->getTableName(),
            $attributes
        );
        return $this->query($query, $values);
    }

    public function delete(): bool
    {
        $this->where([$this->foreignKey => $this->parent->id]);
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getDeleteQuery(
            $this->relatedClass->getTableName(),
            $this->modelWhere->getWhereQuery()
        );
        return (bool)$this->query($query, $this->modelWhere->getWhereData());
    }

    public function update(array $attributes)
    {
        $this->where([$this->foreignKey => $this->parent->id]);
        $this->modelWhere->resolve();
        $values = array_values($attributes);
        $query = $this->queryBuilder->getUpdateQuery(
            $this->relatedClass->getTableName(),
            $attributes,
            $this->modelWhere->getWhereQuery()
        );
        $values = array_merge($values, $this->modelWhere->getWhereData());
        if (!$this->query($query, $values)) {
            return false;
        }
        return $this->getLastId();
    }

}