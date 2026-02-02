<?php

namespace Kernel\Model\Relations;

use Exception;
use Kernel\Model\Model;
use Kernel\Model\Paginator;
use ReflectionClass;

class HasMany extends Relation
{
    protected Model $parent;
    protected mixed $relatedClass;
    protected string $foreignKey;

    private Paginator $paginator;
    public function __construct(Model $parent, string $relatedClass)
    {
        parent::__construct($parent,$relatedClass);
        $this->parent = $parent;
        $this->relatedClass = new $relatedClass();
        $this->foreignKey = strtolower((new ReflectionClass($parent))->getShortName()) . '_id';
        $this->paginator = new Paginator();
    }

    public function paginate()
    {
        $page = request()->get('page') ?? 1;
        $perPage = request()->get('perPage') ?? 10;
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getPaginatedQuery($this->relatedClass->getTableName(), $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());

        $total = (int) $result->fetchColumn();
        $page = max($page, 1);
        $offset = ($page - 1) * $perPage;
        $totalPages = (int)ceil($total / $perPage);

        $query = $this->queryBuilder->getPaginatedSelectQuery($this->relatedClass->getTableName(), $offset, $perPage, $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());

        $data = $this->fetchArrayData($result->fetchAll(\PDO::FETCH_ASSOC));
        $this->paginator->setResponse([
            'data' => $data,
            'total' => $total,
            'total_data' => count($data),
            'perPage' => (int) $perPage,
            'current_page' => (int)$page,
            'total_pages' => $totalPages,
            'has_next' => $page < $totalPages,
            'has_prev' => $page > 1,
        ]);
        $this->relatedClass->setData($this->paginator->getResponse());
        return $this->relatedClass;
    }

    public function appends(array|string $key, $value = null)
    {
        $oldData = $this->paginator->getResponse();
        if (empty($oldData)) {
            throw new Exception('You do not access in appands');
        }
        $this->paginator->appends($key, $value);
        $this->relatedClass->setData($this->paginator->getResponse());
        return $this->relatedClass;
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
        foreach ($model->getWith() as $relation) {
            $related = $model->$relation()->get();
            $model->setRelation($relation, $related);
            $model->setData(array_merge($model->getData(), [$relation => $related]));
        }
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
