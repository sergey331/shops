<?php

namespace Kernel\Model;

class ModelWhere
{
    protected string $whereQuery = "";

    protected array $wheres = [];
    protected array $orWheres = [];

    protected array $data = [];

    public function setWhere($wheres): static
    {
        $this->wheres = array_merge($this->wheres ?? [],$wheres);
        return $this;
    }
    public function setOrWhere($orWheres): static
    {
        $this->orWheres = array_merge($this->orWheres ?? [],$orWheres);
        return $this;
    }

    public function resolve(): static
    {
        if (!empty($this->wheres) || !empty($this->orWheres)) {
            $this->whereQuery = "WHERE ";

            if (!empty($this->wheres)) {
                $keys = array_keys($this->wheres);
                $this->whereQuery .=  implode(', ', array_map(fn($field) => "$field=?", $keys));
                $this->data = array_merge($this->data, array_values($this->wheres));
            }
            if (!empty($this->orWheres)) {
                $keys = array_keys($this->orWheres);
                $this->whereQuery .=  " OR " . implode(', ', array_map(fn($field) => "$field=?", $keys));
                $this->data = array_merge($this->data, array_values($this->orWheres));
            }

        }
        return $this;
    }

    public function getWhereQuery(): string
    {
        return $this->whereQuery;
    }
    public function getWhereData(): array
    {
        return $this->data;
    }



}