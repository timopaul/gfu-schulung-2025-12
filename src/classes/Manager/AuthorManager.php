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
}
