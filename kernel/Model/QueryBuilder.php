<?php

namespace Kernel\Model;

class QueryBuilder
{

    public function getQuery($table,$where = ""): string
    {
        return  "SELECT * FROM $table $where";
    }

}