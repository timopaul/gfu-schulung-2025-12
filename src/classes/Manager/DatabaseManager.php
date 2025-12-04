<?php

namespace App\Manager;

use App\Traits\IsSingleton;
use mysqli;
use mysqli_result;
use RuntimeException;

class DatabaseManager
{
    use IsSingleton;

    private mysqli $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        mysqli_close($this->connection);
    }

    private function connect(): void
    {
        $config = require __DIR__ . '/../../../config/database.php';

        $this->connection = mysqli_connect(
            $config['db_host'],
            $config['db_user'],
            $config['db_pass'],
            $config['db_name'],
        );

        $error = mysqli_connect_error();
        if (null !== $error) {
            throw new RuntimeException('Datenbankverbindung fehlgeschlagen: ' . $error);
        }
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    public function fetchAll(string $query): array
    {
        $result = $this->execute($query);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function fetch(string $query): array|null
    {
        $result = $this->execute($query);

        return mysqli_fetch_assoc($result);
    }

    public function execute(string $query): mysqli_result|bool
    {
        return mysqli_query($this->getConnection(), $query);
    }

    public function prepareString(string $string): string
    {
        return mysqli_real_escape_string($this->getConnection(), $string);
    }

}