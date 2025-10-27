<?php

namespace Kernel\Databases;

use PDO;

class Connection
{
    protected PDO $connection;
    public function __construct()
    {
        $host = config('db.host');
        $database = config('db.database');
        $user = config('db.user');
        $password = config('db.password');
        $driver = config('db.driver');
        try {
            $this->connection = new PDO(
                $driver . ':host=' . $host . ';dbname=' . $database,
                $user,
                $password
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