<?php

namespace Kernel\Model;

class QueryBuilder
{
    protected int $limit = 0;
    protected array $orderBy = [];
    protected array $groupBy = [];
    public function getSelectQuery($table,$where = ""): string
    {
        $sql = "SELECT * FROM {$table}";

        if (!empty($where)) {
            $sql .= " {$where}";
        }

        if (!empty($this->groupBy)) {
            $sql .= " GROUP BY " . implode(', ', $this->groupBy);
        }

        if (!empty($this->orderBy)) {
            $orderClauses = [];
            foreach ($this->orderBy as $column => $direction) {
                $direction = strtoupper($direction);
                $orderClauses[] = "{$column} {$direction}";
            }
            $sql .= " ORDER BY " . implode(', ', $orderClauses);
        }

        if ($this->limit > 0) {
            $sql .= " LIMIT {$this->limit}";
        }

        return $sql;
    }

    public function getInsertQuery($table,$data)
    {
        $keys = array_keys($data);
        $fields = "(" . implode(', ', array_map(fn($field) => "$field", $keys)) . ")";
        $values = "(" . implode(', ', array_map(fn($field) => "?", $keys)) . ")";
        
        return sprintf('INSERT INTO %s %s VALUES %s',$table,$fields,$values);
    }

    public function getUpdateQuery($table,$data, $where)
    {
        $keys = array_keys($data);
        $fields = implode(', ', array_map(fn($field) => "$field=?", $keys));
        
        return sprintf('UPDATE  %s SET %s  %s',$table,$fields,$where);
    }

    public function getDeleteQuery($table, $where)
    {
        return sprintf('DELETE FROM  %s   %s',$table,$where);
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @param array $orderBy
     */
    public function setOrderBy(array $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @param array $groupBy
     */
    public function setGroupBy(array $groupBy): void
    {
        $this->groupBy = $groupBy;
    }

}