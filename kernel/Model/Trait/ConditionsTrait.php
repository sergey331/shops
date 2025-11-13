<?php

namespace Kernel\Model\Trait;

use Kernel\Model\Relations\BelongsToMany;

trait ConditionsTrait
{
    public function where(array $wheres): static
    {
        $this->modelWhere->setWhere($wheres);
        return $this;
    }

    public function orWhere(array $wheres): static
    {
        $this->modelWhere->setOrWhere($wheres);
        return $this;
    }

    public function whereNull(array $columns): static
    {
        $this->modelWhere->setWhereNull($columns);
        return $this;
    }

    public function whereNotNull(array $columns): static
    {
        $this->modelWhere->setWhereNotNull($columns);
        return $this;
    }

    public function orWhereNull(array $columns): static
    {
        $this->modelWhere->setOrWhereNull($columns);
        return $this;
    }

    public function orWhereNotNull(array $columns): static
    {
        $this->modelWhere->setOrWhereNotNull($columns);
        return $this;
    }

    public function whereNotEqual(array $conditions): static
    {
        $this->modelWhere->setNotEquals($conditions);
        return $this;
    }

    public function orWhereNotEqual(array $conditions): static
    {
        $this->modelWhere->setOrNotEquals($conditions);
        return $this;
    }

    public function whereIn(array $conditions): static
    {
        $this->modelWhere->setWhereIn($conditions);
        return $this;
    }

    public function whereNotIn(array $conditions): static
    {
        $this->modelWhere->setWhereNotIn($conditions);
        return $this;
    }

    public function orWhereIn(array $conditions): static
    {
        $this->modelWhere->setOrWhereIn($conditions);
        return $this;
    }

    public function orWhereNotIn(array $conditions): static
    {
        $this->modelWhere->setOrWhereNotIn($conditions);
        return $this;
    }

    public function whereDate(array $conditions): static
    {
        $this->modelWhere->setWhereDates($conditions);
        return $this;
    }

    public function orWhereDate(array $conditions): static
    {
        $this->modelWhere->setOrWhereDates($conditions);
        return $this;
    }

    public function whereDateBetween(array $conditions): static
    {
        $this->modelWhere->setWhereDateBetweens($conditions);
        return $this;
    }

    public function orWhereDateBetween(array $conditions): static
    {
        $this->modelWhere->setOrWhereDateBetweens($conditions);
        return $this;
    }

    public function whereDateNotBetween(array $conditions): static
    {
        $this->modelWhere->setWhereDateNotBetweens($conditions);
        return $this;
    }

    public function orWhereDateNotBetween(array $conditions): static
    {
        $this->modelWhere->setOrWhereDateNotBetweens($conditions);
        return $this;
    }

    public function whereDateOperators(array $conditions): static
    {
        $this->modelWhere->setWhereDateOperators($conditions);
        return $this;
    }

    public function orWhereDateOperators(array $conditions): static
    {
        $this->modelWhere->setOrWhereDateOperators($conditions);
        return $this;
    }
    public function whereHas(string $relation, callable $callback): static
    {
        $relationInstance = $this->$relation();
        if ($relationInstance instanceof BelongsToMany) {
            return $this->addWhereExistsBelongsToMany($relationInstance, $callback);
        }
        $relationInstance = $this->$relation();
        $relatedQuery = $relationInstance->getQueryBuilder();
        $callback($relationInstance);
        $this->addWhereExists($relationInstance, $relatedQuery);
        return $this;
    }
    private function addWhereExistsBelongsToMany($relation, callable $callback)
    {
        $relatedQuery = $relation->getQueryBuilder();
        $callback($relation);

        $pivot = $relation->getPivotTable();
        $related = $relation->getRelatedTable();

        $foreignPivotKey = $relation->getForeignPivotKey();
        $relatedPivotKey = $relation->getRelatedPivotKey();

        $relatedQuery->resolve();


        $relatedWhere = trim($relatedQuery->getWhereQuery() ?? '');
        $relatedWhere = preg_replace('/^\s*WHERE\s+/i', '', $relatedWhere);

        $subQuery = "EXISTS (
        SELECT 1
        FROM {$pivot}
        JOIN {$related} ON {$related}.id = {$pivot}.{$relatedPivotKey}
        WHERE {$pivot}.{$foreignPivotKey} = {$this->getTableName()}.id
    ";

        if ($relatedWhere) {
            $subQuery .= " AND {$relatedWhere}";
        }

        $subQuery .= ")";

        $this->modelWhere->setWhereHas($subQuery,$relatedQuery->getWhereData());

        return $this;
    }

    protected function addWhereExists($relationInstance, $relatedQuery)
    {
        $relatedTable = $relationInstance->getRelatedTable();
        $foreignKey   = $relationInstance->getForeignKey();
        $localKey     = $relationInstance->getLocalKey();


        $relatedQuery->resolve();

        $relatedTable = $relatedTable->getTableName();

        // Append EXISTS subquery
        $subSql = "EXISTS (SELECT 1 FROM {$relatedTable} WHERE {$relatedTable}.{$localKey} = {$this->table}.{$foreignKey}";

        if (!empty($relatedQuery->getWhereData())) {
            $subSql .= ' AND ' . str_replace('WHERE','', $relatedQuery->getWhereQuery());
        }

        $subSql .= ')';

        $this->modelWhere->setWhereHas($subSql,$relatedQuery->getWhereData());
    }
}