<?php

declare(strict_types=1);

use App\Manager\DatabaseManager;

function getArticles(): array
{
    $sql = "SELECT
                a.id,
                au.name AS author,
                a.title,
                a.text,
                a.status
            FROM articles a
                LEFT JOIN authors au ON a.author_id = au.id
            ";

    return DatabaseManager::getInstance()->fetchAll($sql);
}

function getArticleById(int $id): array|null
{
    $sql = "SELECT *
            FROM articles
            WHERE id = {$id}
            ";

    return DatabaseManager::getInstance()->fetch($sql);
}

function getAuthors(): array
{
    $sql = "SELECT
                id,
                name
            FROM authors
            ";

    return DatabaseManager::getInstance()->fetchAll($sql);
}

function insertArticle(string $title, string $text, int $authorId, string $status): bool
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

function updateArticle(int $id, string $title, string $text, int $authorId, string $status): bool
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

function deleteArticle(int $id): bool
{
    $sql = "DELETE FROM articles
            WHERE id = {$id}";

    return DatabaseManager::getInstance()->execute($sql);
}

function isPostRequest(): bool
{
    return HTTP_REQUEST_POST === $_SERVER['REQUEST_METHOD'];
}

function redirectTo(string $page): void
{
    $url = rtrim($_ENV['PROJECT_URL'], '/') . '/' . ltrim($page, '/');

    header('Location: ' . $url);
    exit;
}