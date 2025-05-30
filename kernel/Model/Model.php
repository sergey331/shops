<?php

namespace Kernel\Model;

use Exception;
use Kernel\Databases\Connection;
use Kernel\Hash\Hash;
use Kernel\Model\Relations\BelongsTo;
use Kernel\Model\Relations\HasMany;
use Kernel\Model\Relations\HasOne;
use Kernel\Model\Trait\ConditionsTrait;

#[\AllowDynamicProperties]
class Model extends Connection implements ModelInterface
{
    use ConditionsTrait;
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

    /**
     * @throws Exception
     */
    public function all(): array
    {
        if (!empty($this->modelWhere->getWhereData())) {
            throw new Exception("You cannot use 'all' method with where conditions. Use 'get' or 'first' instead.");
        }
        $query = $this->queryBuilder->getSelectQuery($this->table);
        $result = $this->query($query);
        return $this->fetchArrayData($result->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function get(): array
    {
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getSelectQuery($this->table, $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());
        return $this->fetchArrayData($result->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function first(): null|static
    {
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getSelectQuery($this->table, $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());
        $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
        return !empty($rows) ? $this->fetchData($rows[0]) : null;
    }

    public function find($id): null|static
    {
        return $this->where(['id' => $id])->first();
    }

    public function create(array $data): static
    {
        $this->fill($data);
        $last_id = $this->save();
        return $this->find($last_id);
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
        return (bool)$this->query($query, $this->modelWhere->getWhereData());
    }

    public function fill(array $data): void
    {

        foreach ($data as $key => $value) {
            if (!in_array($key, $this->fillable)) {
                throw new Exception("Field '{$key}' not found");
            }
            $this->newData[$key] = ($this->table === 'users' && $key === 'password')
                ? Hash::make($value)
                : $value;
        }
    }

    public function save(bool $update = false): bool|int
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

        if (!$this->query($query, $values)) {
            return false;
        }
        return $this->getLastId();
    }

    // Query condition methods

    public function orderBy(string|array $column, string $direction = 'ASC'): static
    {
        if (is_array($column)) {
            $orderBy = $column;
        } else {
            $orderBy = [$column => $direction];
        }
        $this->queryBuilder->setOrderBy($orderBy);
        return $this;
    }


    public function groupBy(string|array $column): static
    {
        $groupBy = is_array($column) ? $column : [$column];
        $this->queryBuilder->setGroupBy($groupBy);
        return $this;
    }

    public function limit(int $limit): static
    {
        $this->queryBuilder->setLimit($limit);
        return $this;
    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    // Relationships
    public function belongsTo($model, string $foreignKey = null, string $localKey = null)
    {
        return new BelongsTo($this,$model);
    }

    public function hasMany($model, string $localKey = null, string $foreignKey = null)
    {
        return new HasMany($this,$model);
    }

    public function hasOne($model, string $localKey = null, string $foreignKey = null)
    {
        return new HasOne($this, $model);
    }

    public function with($relations): static
    {
        $this->with = array_merge($this->with, $relations);
        if ($this->id) {
            foreach ($relations as $relation) {
                $related = $this->$relation()->get();
                $this->relations[$relation] = $related;
                $this->data[$relation] = $related;
            }
        }
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
            $related = $model->$relation()->get();
            $model->relations[$relation] = $related;
            $model->data[$relation] = $related;
        }

        return $model;
    }

    public function getTableName()
    {
        return $this->table;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }
}
