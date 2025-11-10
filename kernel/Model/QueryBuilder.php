<?php

namespace Kernel\Model;

use Kernel\Model\interface\QueryBuilderInterface;

class QueryBuilder implements QueryBuilderInterface
{
    protected int $limit = 0;
    protected array $orderBy = [];
    protected array $groupBy = [];

    protected string $selectClause = "*";

    public function select(array|string $columns): void
    {
        $this->selectClause = is_array($columns)
            ? implode(', ', $columns)
            : $columns;
    }
    public function getSelectQuery($table,$where = ""): string
    {
        $sql = "SELECT {$this->selectClause} FROM {$table}";

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

    public function getInsertQuery($table,$data): string
    {
        $keys = array_keys($data);
        $fields = "(" . implode(', ', array_map(fn($field) => "$field", $keys)) . ")";
        $values = "(" . implode(', ', array_map(fn($field) => "?", $keys)) . ")";
        
        return sprintf('INSERT INTO %s %s VALUES %s',$table,$fields,$values);
    }

    public function getUpdateQuery($table,$data, $where): string
    {
        $keys = array_keys($data);
        $fields = implode(', ', array_map(fn($field) => "$field=?", $keys));
        
        return sprintf('UPDATE  %s SET %s  %s',$table,$fields,$where);
    }

    public function getDeleteQuery($table, $where): string
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

    public function getPaginatedQuery($table, $where = ""): string
    {
        // TODO: Implement getPaginatedQuery() method.
    }
}