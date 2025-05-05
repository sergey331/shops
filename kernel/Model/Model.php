<?php

namespace Kernel\Model;

use Kernel\Databases\Connection;

#[\AllowDynamicProperties]
class Model extends Connection
{
    protected string $table;
    protected array $data = [];
    protected array $fillable = [];
    protected array $hidden = [];
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

    public function fill(array $data): void
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->data[$key] = $value;
            } else {
                throw new \Exception("Field '{$key}' not found");
            }
        }

    }

    public function save()
    {
        if (empty($this->data)) {
            return false;
        }

        $query = $this->queryBuilder->getInsertQuery($this->table,$this->data);

        if ($this->table === 'users') {
            if (isset($this->data['password'])) {
                $this->data['password'] = password_hash($this->data['password'],PASSWORD_DEFAULT);
            }
        }
        $values = array_values($this->data);
        if ($this->query($query,$values)) {
            return true;
        }

        return false;
    }

    public function get(): array
    {
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getSelectQuery($this->table, $this->modelWhere->getWhereQuery());
        $result = $this->query($query, $this->modelWhere->getWhereData());
        $result = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $this->fetchArrayData($result);
    }

    public function first()
    {
        $this->modelWhere->resolve();

        $whereClause = $this->modelWhere->getWhereQuery();
        $whereData = $this->modelWhere->getWhereData();

        $query = $this->queryBuilder->getSelectQuery($this->table, $whereClause);
        $result = $this->query($query, $whereData);

        $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
        return !empty($rows) ? $this->fetchData($rows[0]) : null;
    }

    public function find($id)
    {
        $this->where(['id' => $id]);
        return $this->first();
    }

    public function where(array $wheres): static
    {
        $this->modelWhere->setWhere($wheres);
        return $this;
    }

    public function orWhere(array $orWheres): static
    {
        $this->modelWhere->setOrWhere($orWheres);
        return $this;
    }

    public function all()
    {
        $query = $this->queryBuilder->getSelectQuery($this->table);
        $result = $this->query($query, $this->modelWhere->getWhereData());
        return $result->fetchAll(\PDO::ATTR_CASE);
    }

    public function create(array $data): bool
    {
        $this->fill($data);
        return $this->save();
    }

    public function update(array $data): bool
    {
        $this->fill($data);
        return $this->save();
    }

    public function delete(): bool
    {
        return true;
    }

    public function __get(string $name)
    {
        if (!isset($this->data[$name])) {
            return null;
        }

        return $this->data[$name] ;
    }

    private function fetchArrayData($data): array
    {
        $result = [];
        foreach ($data as $row) {
            $model = new  static();
            $model->data = $row;

            $result[] = $model;
        }
        return $result;
    }

    private function fetchData($data): static
    {
        $model = new  static();
        $model->data = $data;
        return $model;
    }
}