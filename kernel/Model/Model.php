<?php

namespace Kernel\Model;

use Kernel\Databases\Connection;

#[\AllowDynamicProperties]
class Model extends Connection implements ModelInterface
{
    protected string $table;
    protected array $data = [];
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

    public function all():array
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
        $query = $this->queryBuilder->getDeleteQuery($this->table,$this->modelWhere->getWhereQuery());
        if ($this->query($query,$this->modelWhere->getWhereData())) {
            return true;
        }
        return false;
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

    public function save($update = false)
    {
        if (empty($this->data)) {
            return false;
        }
        $values = array_values($this->data);
        if ($update) {
            $this->where(['id' => $this->id]);
            $this->modelWhere->resolve();
            $query = $this->queryBuilder->getUpdateQuery($this->table,$this->data,$this->modelWhere->getWhereQuery());
            $values = array_merge($values, $this->modelWhere->getWhereData());
        } else {
            $query = $this->queryBuilder->getInsertQuery($this->table,$this->data);    
        }

        if ($this->table === 'users') {
            if (isset($this->data['password'])) {
                $this->data['password'] = password_hash($this->data['password'],PASSWORD_DEFAULT);
            }
        }
        
        if ($this->query($query,$values)) {
            return true;
        }

        return false;
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

    public function whereNull(array $column): static
    {
        $this->modelWhere->setWhereNull($column);
        return $this;
    }

    public function whereNotNull(array $column): static
    {
        $this->modelWhere->setWhereNotNull($column);
        return $this;
    }

    public function orWhereNull(array $column): static
    {
        $this->modelWhere->setOrWhereNull($column);
        return $this;
    }

    public function orWhereNotNull(array $column): static
    {
        $this->modelWhere->setOrWhereNotNull($column);
        return $this;
    }
    public function whereNotEqual(array $data): static
    {
        $this->modelWhere->setNotEquals($data);
        return $this;
    }

    public function orWhereNotEqual(array $data):static
    {
        $this->modelWhere->setOrNotEquals($data);
        return $this;
    }

    public function whereIn(array $data): static
    {
        $this->modelWhere->setWhereIn($data);
        return $this;
    }

    public function whereNotIn(array $data): static
    {
        $this->modelWhere->setWhereNotIn($data);
        return $this;
    }

    public function orWhereIn(array $data): static
    {
        $this->modelWhere->setOrWhereIn($data);
        return $this;
    }

    public function orWhereNotIn(array $data): static
    {
        $this->modelWhere->setOrWhereNotIn($data);
        return $this;
    }
    public function __get(string $name)
    {
        if (!isset($this->data[$name])) {
            return null;
        }

        return $this->data[$name] ;
    }

    public function belongsTo($model, string $foreignKey = null, string $localKey = null)
    {
        $model = new $model;

        if (!$foreignKey) {
            $foreignKey = lcfirst((new \ReflectionClass($model))->getShortName()) . '_id';
        }
        return $model->where(['id' => $this->$foreignKey]);
    }

    public function with($with)
    {
        $this->with = $with;
        return $this;
    } 

    private function fetchArrayData($data): array
    {
        $result = [];
        foreach ($data as $row) {
          
            $result[] = $this->fetchData($row);
        }
        return $result;
    }

    private function fetchData($data): static
    {
        $model = new  static();
        if (!empty($this->with)) {
            foreach ($this->with as  $value) {
                $a = $this->$value()->get();
                $model->relations[$value] = $a;
                $data[$value] = $a;
            }
        }
        $model->data = $data;
        return $model;
    }
}