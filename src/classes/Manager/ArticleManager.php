<?php

declare(strict_types=1);

namespace App\Manager;

use App\Traits\IsSingleton;

class ArticleManager
{
    use IsSingleton;

    public function getAll(): array
    {
        $sql = 'SELECT
                    a.id,
                    au.name AS author,
                    a.title,
                    a.text,
                    a.status
                FROM articles a
                    LEFT JOIN authors au ON a.author_id = au.id
                ';

        return DatabaseManager::getInstance()->fetchAll($sql);
    }

    public function getOne(int $id): array|null
    {
        $sql = "SELECT *
                FROM articles
                WHERE id = {$id}";

        return DatabaseManager::getInstance()->fetch($sql);
    }

    public function insert(string $title, string $text, int $authorId, string $status): bool
    {
        $db = DatabaseManager::getInstance();

        $titleEscaped = $db->prepareString($title);
        $textEscaped = $db->prepareString($text);
        $statusEscaped = $db->prepareString($status);

        $sql = "INSERT INTO articles
                SET title = '{$titleEscaped}',
                    text = '{$textEscaped}',
                    author_id = {$authorId},
                    status = '{$statusEscaped}'";

        return $db->execute($sql);
    }

    public function update(int $id, string $title, string $text, int $authorId, string $status): bool
    {
        $db = DatabaseManager::getInstance();

        $titleEscaped = $db->prepareString($title);
        $textEscaped = $db->prepareString($text);
        $statusEscaped = $db->prepareString($status);

        $sql = "UPDATE articles
                SET title = '{$titleEscaped}',
                    text = '{$textEscaped}',
                    author_id = {$authorId},
                    status = '{$statusEscaped}'
                WHERE id = {$id}";

        return $db->execute($sql);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM articles
                WHERE id = {$id}";

        return DatabaseManager::getInstance()->execute($sql);
    }
}
