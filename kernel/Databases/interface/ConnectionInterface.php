<?php

namespace Kernel\Databases\interface;

use PDO;

interface ConnectionInterface
{

    public function query($query,$data = []);

    public function getLastId(): false|string;
}