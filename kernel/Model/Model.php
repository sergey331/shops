<?php

namespace Kernel\Model;

class Model
{
    protected string $table;
    protected array $data = [];
    protected array $fillable = [];
    protected array $hidden = [];
    protected array $casts = [];
    protected array $relations = [];

    public function __construct(string $table)
    {
        $this->table = $table;
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

    public function get()
    {

    }

    public function first()
    {

    }

    public function find($id)
    {

    }

    public function where(string $column, string $operator, string $value)
    {

    }

    public function all()
    {

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