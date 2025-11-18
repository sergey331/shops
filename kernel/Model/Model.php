<?php

namespace Kernel\Model;

use Exception;
use Kernel\Databases\Connection;
use Kernel\Hash\Hash;
use Kernel\Model\interface\ModelInterface;
use Kernel\Model\Relations\BelongsTo;
use Kernel\Model\Relations\BelongsToMany;
use Kernel\Model\Relations\HasMany;
use Kernel\Model\Relations\HasOne;
use Kernel\Model\Trait\ConditionsTrait;
use Kernel\Model\Trait\Pluck;

#[\AllowDynamicProperties]
class Model extends Connection implements ModelInterface
{
    use ConditionsTrait, Pluck;

    protected string $table;
    protected array $data = [];
    protected array $newData = [];
    protected array $fillable = [];
    protected array $hidden = [];
    protected array $with = [];
    protected array $casts = [];
    protected array $relations = [];
    protected bool $is_model = true;

    private ModelWhere $modelWhere;
    private QueryBuilder $queryBuilder;
    private Paginator $paginator;

    public function __construct()
    {
        parent::__construct();
        $this->modelWhere = new ModelWhere();
        $this->queryBuilder = new QueryBuilder();
        $this->paginator = new Paginator();
    }

    public function select(array|string $columns): static
    {
        $this->queryBuilder->select($columns);
        return $this;
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

    /**
     * @throws Exception
     */
    public function paginate(): static
    {
        $page = request()->get('page') ?? 1;
        $perPage = request()->get('perPage') ?? 10;
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getPaginatedQuery($this->table, $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());

        $total = (int) $result->fetchColumn();
        $page = max($page, 1);
        $offset = ($page - 1) * $perPage;
        $totalPages = (int)ceil($total / $perPage);

        $query = $this->queryBuilder->getPaginatedSelectQuery($this->table, $offset, $perPage, $this->modelWhere->getWhereQuery());
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
        $this->data = $this->paginator->getResponse();
        return $this;
    }

    public function appends(array|string $key, $value = null): static
    {
        $oldData = $this->paginator->getResponse();
        if (empty($oldData)) {
            throw new Exception('You do not access in appands');
        }
        $this->paginator->appends($key, $value);
        $this->data = $this->paginator->getResponse();
        return $this;
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
            if ($this->is_model && !in_array($key, $this->fillable)) {
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

    public function getTableName(): string
    {
        return $this->table;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    // Relationships
    protected function belongsTo($model): BelongsTo
    {
        return new BelongsTo($this, $model);
    }

    protected function belongsToMany($model, $relatedTable): BelongsToMany
    {
        return new BelongsToMany($this, $model, $relatedTable);
    }

    protected function hasMany($model): HasMany
    {
        return new HasMany($this, $model);
    }

    protected function hasOne($model): HasOne
    {
        return new HasOne($this, $model);
    }

    public function with($relations): static
    {
        $this->with = array_merge($this->with, $relations);
        if ($this->id) {
            foreach ($relations as $key =>  $relation) {
                $this->extracted($relation, $key, $this);
            }
        }
        return $this;
    }

    public function getWith(): array
    {
        return $this->with;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setRelation($key, $value): void
    {
        $this->relations[$key] = $value;
    }

    private function fetchArrayData(array $data): array
    {
        return array_map(fn($row) => $this->fetchData($row), $data);
    }

    private function fetchData(array $row): static
    {
        $model = new static();
        $model->data = $row;

        foreach ($this->with as $key => $relation) {
            $this->extracted($relation, $key, $model);
        }

        return $model;
    }

    protected function setTable($table): void
    {
        $this->table = $table;
        $this->is_model = false;
    }

    private function extracted(mixed $relation, int|string $key, $model): void
    {
        $related = null;
        $k = is_string($relation) ? $relation : $key;
        if (is_string($relation)) {
            $related = $model->{$relation}()->get();
        } elseif ($relation instanceof \Closure) {
            $related = $relation($model->{$key}())->get();
        }
        $model->relations[$k] = $related;
        $model->data[$k] = $related;
    }

}
