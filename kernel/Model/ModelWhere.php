<?php

namespace Kernel\Model;

use Kernel\Model\interface\ModelWhereInterface;

class ModelWhere implements ModelWhereInterface
{
    protected string $whereQuery = "";

    protected array $wheresLike = [];
    protected array $orWheresLike = [];
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
    protected array $whereDateNotBetweens = [];
    protected array $whereDateOperators = [];

    protected array $orWhereDates = [];
    protected array $orWhereDateBetweens = [];
    protected array $orWhereDateNotBetweens = [];
    protected array $orWhereDateOperators = [];
    protected array $whereHas = [];
    public array $orWhereHas = [];

    protected array $whereOp = [];
    protected array $orWhereOp = [];

    public function whereOp(string $field, string $op, $value): static
    {
        $this->whereOp[] = compact('field', 'op', 'value');
        return $this;
    }

    public function orWhereOp(string $field, string $op, $value): static
    {
        $this->orWhereOp[] = compact('field', 'op', 'value');
        return $this;
    }

    public function setWhereLike($likes): static
    {
        $this->wheresLike = array_merge($this->wheresLike ?? [],$likes);
        return $this;
    }
    public function setOrWhereLike($likes): static
    {
        $this->orWheresLike = array_merge($this->orWheresLike ?? [],$likes);
        return $this;
    }
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

    public function clearWhere(): static
    {
        $this->wheres = [];
        $this->data = [];
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

    public function setWhereDateNotBetweens(array $wheres): static
    {
        $this->whereDateNotBetweens = array_merge($this->whereDateNotBetweens ?? [], $wheres);
        return $this;
    }

    public function setOrWhereDateNotBetweens(array $wheres): static
    {
        $this->orWhereDateNotBetweens = array_merge($this->orWhereDateNotBetweens ?? [], $wheres);
        return $this;
    }

    public function setWhereDateOperators(array $wheres): static
    {
        $this->whereDateOperators = array_merge($this->whereDateOperators ?? [], $wheres);
        return $this;
    }

    public function setOrWhereDateOperators(array $wheres): static
    {
        $this->orWhereDateOperators = array_merge($this->orWhereDateOperators ?? [], $wheres);
        return $this;
    }

    public function setWhereHas(string $sql, array $data): static
    {
        // Initialize as array if empty
        if (!isset($this->whereHas)) {
            $this->whereHas = [];
        }

        // Append new whereHas clause
        $this->whereHas[] = [
            'sql'  => $sql,
            'data' => $data
        ];

        return $this;
    }

    public function setOrWhereHas(string $sql, array $data): static
    {
        if (!isset($this->orWhereHas)) {
            $this->orWhereHas = [];
        }

        $this->orWhereHas[] = [
            'sql'  => $sql,
            'data' => $data
        ];

        return $this;
    }


    /**
     * Resolves the where clauses and returns the instance for method chaining.
     *
     * @return static
     */
    public function resolve(): static
    {
        $and = [];   // AND conditions
        $or  = [];   // OR conditions
        $data = [];

        /* ----------------------------------------------------
        | 1) WHERE HAS (AND)
        ---------------------------------------------------- */
        if (!empty($this->whereHas)) {
            $parts = [];
            foreach ($this->whereHas as $item) {
                $parts[] = '(' . $item['sql'] . ')';
                $data = array_merge($data, $item['data']);
            }
            $and[] = implode(' AND ', $parts);
        }

        /* ----------------------------------------------------
         | 2) OR WHERE HAS
         ---------------------------------------------------- */
        if (!empty($this->orWhereHas)) {
            $parts = [];
            foreach ($this->orWhereHas as $item) {
                $parts[] = '(' . $item['sql'] . ')';
                $data = array_merge($data, $item['data']);
            }
            $or[] = '(' . implode(' OR ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 3) WHERE LIKE (AND)
         ---------------------------------------------------- */
        if (!empty($this->wheresLike)) {
            $parts = array_map(fn($f) => "$f LIKE ?", array_keys($this->wheresLike));
            $and[] = '(' . implode(' AND ', $parts) . ')';
            $data = array_merge($data, array_values($this->wheresLike));
        }

        /* ----------------------------------------------------
         | 4) OR WHERE LIKE
         ---------------------------------------------------- */
        if (!empty($this->orWheresLike)) {
            $parts = array_map(fn($f) => "$f LIKE ?", array_keys($this->orWheresLike));
            $or[] = '(' . implode(' OR ', $parts) . ')';
            $data = array_merge($data, array_values($this->orWheresLike));
        }

        /* ----------------------------------------------------
         | 5) WHERE = (AND)
         ---------------------------------------------------- */
        if (!empty($this->wheres)) {
            $parts = array_map(fn($f) => "$f=?", array_keys($this->wheres));
            $and[] = '(' . implode(' AND ', $parts) . ')';
            $data = array_merge($data, array_values($this->wheres));
        }

        /* ----------------------------------------------------
         | 6) OR WHERE =
         ---------------------------------------------------- */
        if (!empty($this->orWheres)) {
            $parts = array_map(fn($f) => "$f=?", array_keys($this->orWheres));
            $or[] = '(' . implode(' OR ', $parts) . ')';
            $data = array_merge($data, array_values($this->orWheres));
        }

        foreach ($this->whereOp as $h) {
    $and[] = "({$h['field']} {$h['op']} ?)";
    $data[] = $h['value'];
}

// OR WHERE field OP ?
foreach ($this->orWhereOp as $h) {
    $or[] = "({$h['field']} {$h['op']} ?)";
    $data[] = $h['value'];
}
// dd($data);
        /* ----------------------------------------------------
         | 7) WHERE != (AND)
         ---------------------------------------------------- */
        if (!empty($this->notEquals)) {
            $parts = array_map(fn($f) => "$f!=?", array_keys($this->notEquals));
            $and[] = '(' . implode(' AND ', $parts) . ')';
            $data = array_merge($data, array_values($this->notEquals));
        }

        /* ----------------------------------------------------
         | 8) OR WHERE !=
         ---------------------------------------------------- */
        if (!empty($this->orNotEquals)) {
            $parts = array_map(fn($f) => "$f!=?", array_keys($this->orNotEquals));
            $or[] = '(' . implode(' OR ', $parts) . ')';
            $data = array_merge($data, array_values($this->orNotEquals));
        }

        /* ----------------------------------------------------
         | 9) WHERE NULL (AND)
         ---------------------------------------------------- */
        if (!empty($this->whereNull)) {
            $parts = array_map(fn($f) => "$f IS NULL", array_values($this->whereNull));
            $and[] = '(' . implode(' AND ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 10) OR WHERE NULL
         ---------------------------------------------------- */
        if (!empty($this->orWhereNull)) {
            $parts = array_map(fn($f) => "$f IS NULL", array_values($this->orWhereNull));
            $or[] = '(' . implode(' OR ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 11) WHERE NOT NULL (AND)
         ---------------------------------------------------- */
        if (!empty($this->whereNotNull)) {
            $parts = array_map(fn($f) => "$f IS NOT NULL", array_values($this->whereNotNull));
            $and[] = '(' . implode(' AND ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 12) OR WHERE NOT NULL
         ---------------------------------------------------- */
        if (!empty($this->orWhereNotNull)) {
            $parts = array_map(fn($f) => "$f IS NOT NULL", array_values($this->orWhereNotNull));
            $or[] = '(' . implode(' OR ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 13) WHERE IN (AND)
         ---------------------------------------------------- */
        if (!empty($this->whereIn)) {
            foreach ($this->whereIn as $field => $values) {
                $ph = implode(', ', array_fill(0, count($values), '?'));
                $and[] = "$field IN ($ph)";
                $data = array_merge($data, $values);
            }
        }

        /* ----------------------------------------------------
         | 14) WHERE NOT IN (AND)
         ---------------------------------------------------- */
        if (!empty($this->whereNotIn)) {
            foreach ($this->whereNotIn as $field => $values) {
                $ph = implode(', ', array_fill(0, count($values), '?'));
                $and[] = "$field NOT IN ($ph)";
                $data = array_merge($data, $values);
            }
        }

        /* ----------------------------------------------------
         | 15) OR WHERE IN
         ---------------------------------------------------- */
        if (!empty($this->orWhereIn)) {
            $parts = [];
            foreach ($this->orWhereIn as $field => $values) {
                $ph = implode(', ', array_fill(0, count($values), '?'));
                $parts[] = "$field IN ($ph)";
                $data = array_merge($data, $values);
            }
            $or[] = '(' . implode(' OR ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 16) OR WHERE NOT IN
         ---------------------------------------------------- */
        if (!empty($this->orWhereNotIn)) {
            $parts = [];
            foreach ($this->orWhereNotIn as $field => $values) {
                $ph = implode(', ', array_fill(0, count($values), '?'));
                $parts[] = "$field NOT IN ($ph)";
                $data = array_merge($data, $values);
            }
            $or[] = '(' . implode(' OR ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 17) DATE EQUAL (AND)
         ---------------------------------------------------- */
        foreach ($this->whereDates as $field => $date) {
            $and[] = "$field = ?";
            $data[] = $date;
        }

        /* ----------------------------------------------------
         | 18) DATE BETWEEN (AND)
         ---------------------------------------------------- */
        foreach ($this->whereDateBetweens as $field => $range) {
            $and[] = "$field BETWEEN ? AND ?";
            $data[] = $range[0];
            $data[] = $range[1];
        }

        /* ----------------------------------------------------
         | 19) DATE NOT BETWEEN (AND)
         ---------------------------------------------------- */
        foreach ($this->whereDateNotBetweens as $field => $range) {
            $and[] = "$field NOT BETWEEN ? AND ?";
            $data[] = $range[0];
            $data[] = $range[1];
        }

        /* ----------------------------------------------------
         | 20) DATE OPERATORS (AND)
         ---------------------------------------------------- */
        foreach ($this->whereDateOperators as $field => [$op, $value]) {
            $and[] = "$field $op ?";
            $data[] = $value;
        }

        /* ----------------------------------------------------
         | 21) OR DATE EQUAL
         ---------------------------------------------------- */
        if (!empty($this->orWhereDates)) {
            $parts = [];
            foreach ($this->orWhereDates as $field => $date) {
                $parts[] = "$field = ?";
                $data[] = $date;
            }
            $or[] = '(' . implode(' OR ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 22) OR DATE BETWEEN
         ---------------------------------------------------- */
        if (!empty($this->orWhereDateBetweens)) {
            $parts = [];
            foreach ($this->orWhereDateBetweens as $field => $range) {
                $parts[] = "$field BETWEEN ? AND ?";
                $data[] = $range[0];
                $data[] = $range[1];
            }
            $or[] = '(' . implode(' OR ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 23) OR DATE NOT BETWEEN
         ---------------------------------------------------- */
        if (!empty($this->orWhereDateNotBetweens)) {
            $parts = [];
            foreach ($this->orWhereDateNotBetweens as $field => $range) {
                $parts[] = "$field NOT BETWEEN ? AND ?";
                $data[] = $range[0];
                $data[] = $range[1];
            }
            $or[] = '(' . implode(' OR ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | 24) OR DATE OPERATORS
         ---------------------------------------------------- */
        if (!empty($this->orWhereDateOperators)) {
            $parts = [];
            foreach ($this->orWhereDateOperators as $field => [$op, $value]) {
                $parts[] = "$field $op ?";
                $data[] = $value;
            }
            $or[] = '(' . implode(' OR ', $parts) . ')';
        }

        /* ----------------------------------------------------
         | FINAL QUERY MERGE
         ---------------------------------------------------- */

        $andSql = !empty($and) ? implode(' AND ', $and) : '';
        $orSql  = !empty($or)  ? implode(' OR ', $or)  : '';

        if ($andSql && $orSql) {
            // AND + OR together
            $this->whereQuery = "WHERE ($andSql) OR ($orSql)";
        }
        elseif ($andSql) {
            // Only AND
            $this->whereQuery = "WHERE $andSql";
        }
        elseif ($orSql) {
            // Only OR
            $this->whereQuery = "WHERE $orSql";
        }

        $this->data = array_merge($this->data, $data);

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