<?php

namespace Kernel\Model\Relations;

use Kernel\Model\Model;
use Kernel\Model\Trait\Pluck;
use ReflectionClass;

class BelongsToMany extends Relation
{
    use Pluck;

    protected Model $parent;
    protected mixed $relatedClass;
    protected string $relatedTable;
    protected string $foreignKey;
    protected string $relatedKey;
    protected array $data = [];

    public function __construct(Model $parent, string $relatedClass, string $relatedTable)
    {
        parent::__construct($parent, $relatedClass);

        $this->parent = $parent;
        $this->relatedClass = new $relatedClass();
        $this->relatedTable = $relatedTable;

        $relatedShort = strtolower((new ReflectionClass($this->relatedClass))->getShortName());
        $parentShort = strtolower((new ReflectionClass($parent))->getShortName());

        $this->foreignKey = $relatedShort . '_id';
        $this->relatedKey = $parentShort . '_id';
    }

    public function get(): array
    {
        $parentRows = $this->getPivotRows();

        $this->data = array_map(
            fn($row) => $this->instantiateRelatedModel($row),
            $parentRows
        );

        return $this->data;
    }

    public function getPivotTable(): string
    {
        return $this->relatedTable;
    }

    public function getForeignPivotKey(): string
    {
        return $this->relatedKey;
    }

    public function getRelatedPivotKey(): string
    {
        return $this->foreignKey;
    }

    public function getRelatedTable(): string
    {
        return $this->relatedClass->getTableName();
    }

    public function getQueryBuilder()
    {
        return $this->modelWhere;
    }

    private function getPivotRows(): array
    {
        $this->modelWhere->clearWhere();
        $this->where([$this->relatedKey => $this->parent->id]);
        $this->modelWhere->resolve();

        $query = $this->queryBuilder->getSelectQuery(
            $this->relatedTable,
            $this->modelWhere->getWhereQuery()
        );

        $stmt = $this->query($query, $this->modelWhere->getWhereData());
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function instantiateRelatedModel(array $pivotRow): Model
    {
        $this->modelWhere->clearWhere();
        $this->where(['id' => $pivotRow[$this->foreignKey]]);
        $this->modelWhere->resolve();

        $query = $this->queryBuilder->getSelectQuery(
            $this->relatedClass->getTableName(),
            $this->modelWhere->getWhereQuery()
        );

        $stmt = $this->query($query, $this->modelWhere->getWhereData());
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $model = new $this->relatedClass();
        $model->setData($row ?: []);
        return $model;
    }
}
