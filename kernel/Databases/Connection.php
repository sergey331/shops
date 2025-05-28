<?php

namespace Kernel\Databases;

use PDO;

class Connection
{
    protected PDO $connection;
    public function __construct()
    {
        $config = require APP_PATH . '/config/db.php';
        try {
            $this->connection = new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['user'],
                $config['password']
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function query($query,$data = [])
    {
        try {
            if (empty($data)) {
                return $this->connection->query($query);
            }
            $smtp = $this->connection->prepare($query);
            $smtp->execute($data);
            return $smtp;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function getLastId(): false|string
    {
        return $this->connection->lastInsertId();
    }
}