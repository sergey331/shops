<?php

namespace Kernel\Model;

use Kernel\Databases\Connection;

#[\AllowDynamicProperties]
class Model extends Connection implements ModelInterface
{
    protected string $table;
    protected array $data = [];
    protected array $newData = [];
    protected array $fillable = [];
    protected array $hidden = [];
    protected array $with = [];
    protected array $casts = [];
    protected array $relations = [];

    private ModelWhere $modelWhere;
    private QueryBuilder $queryBuilder;

    public function __construct()
    {
        parent::__construct();
        $this->modelWhere = new ModelWhere();
        $this->queryBuilder = new QueryBuilder();
    }

    public function all(): array
    {
        $query = $this->queryBuilder->getSelectQuery($this->table);
        $result = $this->query($query, $this->modelWhere->getWhereData());
        return $result->fetchAll(\PDO::ATTR_CASE);
    }

    public function get(): array
    {
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getSelectQuery($this->table, $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());
        return $this->fetchArrayData($result->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function first()
    {
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getSelectQuery($this->table, $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());
        $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
        return !empty($rows) ? $this->fetchData($rows[0]) : null;
    }

    public function find($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function create(array $data): bool
    {
        $this->fill($data);
        return $this->save();
    }

    public function update(array $data): bool
    {
        $this->fill($data);
        return $this->save(true);
    }

    public function delete(): bool
    {
        $this->where(['id' => $this->id]);
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getDeleteQuery($this->table, $this->modelWhere->getWhereQuery());
        return (bool) $this->query($query, $this->modelWhere->getWhereData());
    }

    public function fill(array $data): void
    {

        foreach ($data as $key => $value) {
            if (!in_array($key, $this->fillable)) {
                throw new \Exception("Field '{$key}' not found");
            }
            $this->newData[$key] = ($this->table === 'users' && $key === 'password')
                ? password_hash($value, PASSWORD_DEFAULT)
                : $value;
        }
    }

    public function save(bool $update = false): bool
    {
        if (empty($this->newData)) {
            return false;
        }

        $values = array_values($this->newData);
        if ($update) {
            $this->where(['id' => $this->id]);
            $this->modelWhere->resolve();
            $query = $this->queryBuilder->getUpdateQuery($this->table, $this->newData, $this->modelWhere->getWhereQuery());

            $values = array_merge($values, $this->modelWhere->getWhereData());
        } else {
            $query = $this->queryBuilder->getInsertQuery($this->table, $this->newData);
        }

        return (bool) $this->query($query, $values);
    }

    // Query condition methods
    public function where(array $wheres): static { $this->modelWhere->setWhere($wheres); return $this; }
    public function orWhere(array $wheres): static { $this->modelWhere->setOrWhere($wheres); return $this; }
    public function whereNull(array $columns): static { $this->modelWhere->setWhereNull($columns); return $this; }
    public function whereNotNull(array $columns): static { $this->modelWhere->setWhereNotNull($columns); return $this; }
    public function orWhereNull(array $columns): static { $this->modelWhere->setOrWhereNull($columns); return $this; }
    public function orWhereNotNull(array $columns): static { $this->modelWhere->setOrWhereNotNull($columns); return $this; }
    public function whereNotEqual(array $conditions): static { $this->modelWhere->setNotEquals($conditions); return $this; }
    public function orWhereNotEqual(array $conditions): static { $this->modelWhere->setOrNotEquals($conditions); return $this; }
    public function whereIn(array $conditions): static { $this->modelWhere->setWhereIn($conditions); return $this; }
    public function whereNotIn(array $conditions): static { $this->modelWhere->setWhereNotIn($conditions); return $this; }
    public function orWhereIn(array $conditions): static { $this->modelWhere->setOrWhereIn($conditions); return $this; }
    public function orWhereNotIn(array $conditions): static { $this->modelWhere->setOrWhereNotIn($conditions); return $this; }

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    // Relationships
    public function belongsTo($model, string $foreignKey = null, string $localKey = null)
    {
        $instance = new $model;
        $foreignKey = $foreignKey ?: lcfirst((new \ReflectionClass($instance))->getShortName()) . '_id';
        return $instance->where(['id' => $this->$foreignKey])->first();
    }

    public function hasMany($model, string $localKey = null, string $foreignKey = null)
    {
        return $this->getHasRelation($model, $localKey, $foreignKey)->get();
    }

    public function hasOne($model, string $localKey = null, string $foreignKey = null)
    {
        return $this->getHasRelation($model, $localKey, $foreignKey)->first();
    }

    public function with($relations): static
    {
        $this->with = array_merge($this->with, $relations);
        return $this;
    }

    private function fetchArrayData(array $data): array
    {
        return array_map(fn($row) => $this->fetchData($row), $data);
    }

    private function fetchData(array $row): static
    {
        $model = new static();
        $model->data = $row;

        foreach ($this->with as $relation) {
            $related = $model->$relation();
            $model->relations[$relation] = $related;
            $model->data[$relation] = $related;
        }

        return $model;
    }

    private function getHasRelation($model, string $localKey = null, string $foreignKey = null)
    {
        $instance = new $model;
        $foreignKey = $foreignKey ?: lcfirst((new \ReflectionClass($this))->getShortName()) . '_id';
        $localKey = $localKey ?: 'id';

        return $instance->where([$foreignKey => $this->$localKey]);
    }
}
