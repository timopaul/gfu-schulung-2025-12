<?php

declare(strict_types=1);

namespace App\Manager;

use App\Traits\IsSingleton;

class AuthorManager
{
    use IsSingleton;

    public function getAll(): array
    {
        $sql = 'SELECT
                    id,
                    name
                FROM authors
                ';

        return DatabaseManager::getInstance()->fetchAll($sql);
    }

    public function getOne(int $id): array|null
    {
        $sql = "SELECT
                    id,
                    name
                FROM authors
                WHERE id = {$id}";

        return DatabaseManager::getInstance()->fetch($sql);
    }
}
