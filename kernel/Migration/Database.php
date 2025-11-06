<?php

namespace Kernel\Migration;

use Kernel\Migration\interface\DatabaseInterface;
use PDO;

class Database implements DatabaseInterface
{
    private $charset;

    public function __construct()
    {
        $this->charset = 'utf8mb4';
    }

    public function connectPDO($host, $user, $pass, $dbname = null): PDO
    {
        $dsn = "mysql:host=$host" . ($dbname ? ";dbname=$dbname" : "") . ";charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}