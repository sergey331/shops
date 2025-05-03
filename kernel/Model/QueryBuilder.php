<?php

namespace Kernel\Model;

class QueryBuilder
{

    public function getSelectQuery($table,$where = ""): string
    {
        return sprintf("SELECT * FROM %s %s", $table, $where);
    }

    public function getInsertQuery($table,$data)
    {
        $keys = array_keys($data);
        $fields = "(" . implode(', ', array_map(fn($field) => "$field", $keys)) . ")";
        $values = "(" . implode(', ', array_map(fn($field) => "?", $keys)) . ")";
        
        return sprintf('INSERT INTO %s %s VALUES %s',$table,$fields,$values);
    }

}