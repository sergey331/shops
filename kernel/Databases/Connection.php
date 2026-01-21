<?php

namespace Kernel\Databases;

use Kernel\Databases\interface\ConnectionInterface;
use PDO;

class Connection implements ConnectionInterface
{
    protected static ?PDO $pdo = null;

    public function __construct()
    {
        if (self::$pdo !== null) {
            return;
        }

        $host = config('db.host');
        $port = config('db.port');
        $database = config('db.database');
        $user = config('db.user');
        $password = config('db.password');
        $driver = config('db.driver');

        try {
            self::$pdo = new PDO(
                "{$driver}:host={$host};port={$port};dbname={$database};charset=utf8mb4",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => true, // IMPORTANT
                ]
            );
        } catch (\PDOException $exception) {
            die("Database connection failed: " . $exception->getMessage());
        }
    }

    protected function getConnection(): PDO
    {
        return self::$pdo;
    }

    public function query($query,$data = [])
    {
        try {
            $pdo = $this->getConnection();

            if (empty($data)) {
                return $pdo->query($query);
            }

            $stmt = $pdo->prepare($query);
            $stmt->execute($data);
            return $stmt;

        } catch (\PDOException $exception) {
            throw $exception; // DO NOT echo in production
        }
    }

    public function getLastId(): false|string
    {
        return self::$pdo->lastInsertId();
    }
}
