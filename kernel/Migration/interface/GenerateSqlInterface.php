<?php

namespace Kernel\Migration\interface;

interface GenerateSqlInterface
{
    public function generateCreateTableSql(): string;

    public function generateAlterTableSql(): string;
}