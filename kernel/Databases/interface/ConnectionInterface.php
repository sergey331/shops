<?php

namespace Kernel\Databases\interface;

use PDO;

interface ConnectionInterface
{
    public function __construct();

    public function query($query,$data = []);

    public function getLastId(): false|string;
}