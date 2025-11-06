<?php

namespace Kernel\Migration\interface;

use Kernel\Migration\Fields;
use Kernel\Migration\GenerateSql;

interface TableInterface
{

    public function createTable($name, $callback): void;

    public function updateAlterTable($name, $callback): void;

    public function dropTable($name): void;

    public function getSql(): string;
}