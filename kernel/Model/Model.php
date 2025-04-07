<?php

namespace Kernel\Model;

use Kernel\Databases\Connection;

class Model extends Connection
{
    protected string $table;
    protected array $data = [];
    protected array $fillable = [];
    protected array $hidden = [];
    protected array $casts = [];
    protected array $relations = [];
    protected ModelWhere $modelWhere;
    protected QueryBuilder $queryBuilder;

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
            }
        }

    }

    public function save(): bool
    {
        return true;
    }

    public function get(): array
    {
        $this->modelWhere->resolve();
        $query = $this->queryBuilder->getQuery($this->table,$this->modelWhere->getWhereQuery());
        $result = $this->query($query,$this->modelWhere->getWhereData());
        return $result->fetchAll(\PDO::ATTR_CASE);
    }

    public function first()
    {
        $this->modelWhere->resolve();

        $whereClause = $this->modelWhere->getWhereQuery();
        $whereData = $this->modelWhere->getWhereData();

        $query = $this->queryBuilder->getQuery($this->table, $whereClause);
        $result = $this->query($query, $whereData);

        $rows = $result->fetchAll(\PDO::ATTR_CASE);

        return $rows[0] ?? null;
    }

    public function find($id)
    {

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
        $query = $this->queryBuilder->getQuery($this->table);
        $result = $this->query($query,$this->modelWhere->getWhereData());
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
}