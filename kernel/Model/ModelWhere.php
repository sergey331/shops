<?php

namespace Kernel\Model;

class ModelWhere
{
    protected string $whereQuery = "";

    protected array $wheres = [];
    protected array $orWheres = [];
    protected array $notEquals = [];
    protected array $orNotEquals = [];
    public array $whereNull = [];
    public array $whereNotNull = [];

    public array $orWhereNull = [];
    public array $orWhereNotNull = [];

    public array $whereIn = [];
    public array $whereNotIn = [];

    public array $orWhereIn = [];
    public array $orWhereNotIn = [];
    protected array $data = [];

    protected array $whereDates = [];
    protected array $whereDateBetweens = [];
    protected array $orWhereDates = [];
    protected array $orWhereDateBetweens = [];

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

    public function setNotEquals($notEquals): static
    {
        $this->notEquals = array_merge($this->notEquals ?? [],$notEquals);
        return $this;
    }

    public function setOrNotEquals($orNotEquals): static
    {
        $this->notEquals = array_merge($this->orNotEquals ?? [],$orNotEquals);
        return $this;
    }

    public function setWhereNull(array $wheres): static
    {
        $this->whereNull = array_merge($this->whereNull ?? [],$wheres);
        return $this;
    }

    public function setWhereNotNull(array $wheres): static
    {
        $this->whereNotNull = array_merge($this->whereNotNull ?? [],$wheres);
        return $this;
    }

    public function setOrWhereNull(array $wheres): static
    {
        $this->orWhereNull = array_merge($this->orWhereNull ?? [],$wheres);
        return $this;
    }

    public function setOrWhereNotNull(array $wheres): static
    {
        $this->orWhereNotNull = array_merge($this->orWhereNotNull ?? [],$wheres);
        return $this;
    }

    public function setWhereIn(array $wheres): static
    {
        $this->whereIn = array_merge($this->whereIn ?? [],$wheres);
        return $this;
    }

    public function setWhereNotIn(array $wheres): static
    {
        $this->whereNotIn = array_merge($this->whereNotIn ?? [],$wheres);
        return $this;
    }

    public function setOrWhereIn(array $wheres): static
    {
        $this->orWhereIn = array_merge($this->orWhereIn ?? [],$wheres);
        return $this;
    }

    public function setOrWhereNotIn(array $wheres): static
    {
        $this->orWhereNotIn = array_merge($this->orWhereNotIn ?? [],$wheres);
        return $this;
    }

    public function setWhereDates(array $wheres): static
    {
        $this->whereDates = array_merge($this->whereDates ?? [], $wheres);
        return $this;
    }

    public function setWhereDateBetweens(array $wheres): static
    {
        $this->whereDateBetweens = array_merge($this->whereDateBetweens ?? [], $wheres);
        return $this;
    }

    public function setOrWhereDates(array $wheres): static
    {
        $this->orWhereDates = array_merge($this->orWhereDates ?? [], $wheres);
        return $this;
    }

    public function setOrWhereDateBetweens(array $wheres): static
    {
        $this->orWhereDateBetweens = array_merge($this->orWhereDateBetweens ?? [], $wheres);
        return $this;
    }
    public function resolve(): static
    {
        $clauses = [];
        $data = [];

        if (!empty($this->wheres)) {
            $parts = array_map(fn($field) => "$field=?", array_keys($this->wheres));
            $clauses[] = implode(' AND ', $parts);
            $data = array_merge($data, array_values($this->wheres));
        }

        if (!empty($this->orWheres)) {
            $parts = array_map(fn($field) => "$field=?", array_keys($this->orWheres));
            $clauses[] = '(' . implode(' OR ', $parts) . ')';
            $data = array_merge($data, array_values($this->orWheres));
        }

        if (!empty($this->notEquals)) {
            $parts = array_map(fn($field) => "$field!=?", array_keys($this->notEquals));
            $clauses[] = implode(' AND ', $parts);
            $data = array_merge($data, array_values($this->notEquals));
        }

        if (!empty($this->orNotEquals)) {
            $parts = array_map(fn($field) => "$field!=?", array_keys($this->orNotEquals));
            $clauses[] = '(' . implode(' OR ', $parts) . ')';
            $data = array_merge($data, array_values($this->orNotEquals));
        }

        if (!empty($this->whereNull)) {
            $parts = array_map(fn($field) => "$field IS NULL", array_values($this->whereNull));
            $clauses[] = '(' . implode(' AND ', $parts) . ')';
        }

        if (!empty($this->orWhereNull)) {
            $parts = array_map(fn($field) => "$field IS NULL", array_values($this->orWhereNull));
            $clauses[] = '(' . implode(' OR ', $parts) . ')';
        }

        if (!empty($this->whereNotNull)) {
            $parts = array_map(fn($field) => "$field IS NOT NULL", array_values($this->whereNotNull));
            $clauses[] = '(' . implode(' AND ', $parts) . ')';
        }

        if (!empty($this->orWhereNotNull)) {
            $parts = array_map(fn($field) => "$field IS NOT NULL", array_values($this->orWhereNotNull));
            $clauses[] = '(' . implode(' OR ', $parts) . ')';
        }

        if (!empty($this->whereIn)) {
            foreach ($this->whereIn as $field => $values) {
                $placeholders = implode(', ', array_fill(0, count($values), '?'));
                $clauses[] = "$field IN ($placeholders)";
                $data = array_merge($data, $values);
            }
        }

        if (!empty($this->whereNotIn)) {
            foreach ($this->whereNotIn as $field => $values) {
                $placeholders = implode(', ', array_fill(0, count($values), '?'));
                $clauses[] = "$field NOT IN ($placeholders)";
                $data = array_merge($data, $values);
            }
        }

        if (!empty($this->orWhereIn)) {
            $orParts = [];
            foreach ($this->orWhereIn as $field => $values) {
                $placeholders = implode(', ', array_fill(0, count($values), '?'));
                $orParts[] = "$field IN ($placeholders)";
                $data = array_merge($data, $values);
            }
            $clauses[] = '(' . implode(' OR ', $orParts) . ')';
        }
        if (!empty($this->orWhereNotIn)) {
            $orParts = [];
            foreach ($this->orWhereNotIn as $field => $values) {
                $placeholders = implode(', ', array_fill(0, count($values), '?'));
                $orParts[] = "$field NOT IN ($placeholders)";
                $data = array_merge($data, $values);
            }
            $clauses[] = '(' . implode(' OR ', $orParts) . ')';
        }

        if (!empty($this->whereDates)) {
            foreach ($this->whereDates as $field => $date) {
                $clauses[] = "$field = ?";
                $data[] = $date;
            }
        }

        if (!empty($this->whereDateBetweens)) {
            foreach ($this->whereDateBetweens as $field => $range) {
                if (count($range) === 2) {
                    $clauses[] = "$field BETWEEN ? AND ?";
                    $data[] = $range[0];
                    $data[] = $range[1];
                }
            }
        }

        if (!empty($this->orWhereDates)) {
            $orParts = [];
            foreach ($this->orWhereDates as $field => $date) {
                $orParts[] = "$field = ?";
                $data[] = $date;
            }
            $clauses[] = '(' . implode(' OR ', $orParts) . ')';
        }

        if (!empty($this->orWhereDateBetweens)) {
            $orParts = [];
            foreach ($this->orWhereDateBetweens as $field => $range) {
                if (count($range) === 2) {
                    $orParts[] = "$field BETWEEN ? AND ?";
                    $data[] = $range[0];
                    $data[] = $range[1];
                }
            }
            if (!empty($orParts)) {
                $clauses[] = '(' . implode(' OR ', $orParts) . ')';
            }
        }

        if (!empty($clauses)) {
            $this->whereQuery = 'WHERE ' . implode(' AND ', $clauses);
            $this->data = array_merge($this->data, $data);
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