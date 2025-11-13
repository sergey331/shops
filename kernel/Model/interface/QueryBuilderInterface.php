<?php

namespace Kernel\Model\interface;

interface QueryBuilderInterface
{
    public function select(array|string $columns): void;

    public function getSelectQuery($table,$where = ""): string;
    public function getPaginatedQuery($table,$where = ""): string;
    public function getPaginatedSelectQuery($table,$offset,$limit, $where = ""): string;

    public function getInsertQuery($table,$data): string;

    public function getUpdateQuery($table,$data, $where): string;

    public function getDeleteQuery($table, $where):string;

    public function setLimit(int $limit): void;

    public function setOrderBy(array $orderBy): void;

    public function setGroupBy(array $groupBy): void;

}