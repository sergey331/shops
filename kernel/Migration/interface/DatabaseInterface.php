<?php

namespace Kernel\Migration\interface;

use PDO;

interface DatabaseInterface
{
    public function connectPDO($host, $user, $pass, $dbname = null): PDO;
}