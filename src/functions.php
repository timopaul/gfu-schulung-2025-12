<?php

declare(strict_types=1);

function getArticles(): array
{
    $config = require __DIR__ . '/../config/database.php';

    $con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    $sql = "SELECT
                a.id,
                au.name AS author,
                a.title,
                a.text,
                a.status
            FROM articles a
                LEFT JOIN authors au ON a.author_id = au.id
            ";

    $result = mysqli_query($con, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getArticleById(int $id): array|null
{
    $config = require __DIR__ . '/../config/database.php';

    $con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    $sql = "SELECT *
            FROM articles
            WHERE id = {$id}
            ";

    $result = mysqli_query($con, $sql);

    return mysqli_fetch_assoc($result);
}

function getAuthors(): array
{
    $config = require __DIR__ . '/../config/database.php';

    $con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    $sql = "SELECT
                id,
                name
            FROM authors
            ";

    $result = mysqli_query($con, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function insertArticle(string $title, string $text, int $authorId, string $status): bool
{
    $config = require __DIR__ . '/../config/database.php';

    $con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    $titleEscaped = mysqli_real_escape_string($con, $title);
    $textEscaped = mysqli_real_escape_string($con, $text);
    $statusEscaped = mysqli_real_escape_string($con, $status);

    $sql = "INSERT INTO articles
            SET title = '{$titleEscaped}',
                text = '{$textEscaped}',
                author_id = {$authorId},
                status = '{$statusEscaped}'";

    return mysqli_query($con, $sql);
}

function updateArticle(int $id, string $title, string $text, int $authorId, string $status): bool
{
    $config = require __DIR__ . '/../config/database.php';

    $con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    $titleEscaped = mysqli_real_escape_string($con, $title);
    $textEscaped = mysqli_real_escape_string($con, $text);
    $statusEscaped = mysqli_real_escape_string($con, $status);

    $sql = "UPDATE articles
            SET title = '{$titleEscaped}',
                text = '{$textEscaped}',
                author_id = {$authorId},
                status = '{$statusEscaped}'
            WHERE id = {$id}";

    return mysqli_query($con, $sql);
}

function deleteArticle(int $id): bool
{
    $config = require __DIR__ . '/../config/database.php';

    $con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    $sql = "DELETE FROM articles
            WHERE id = {$id}";

    return mysqli_query($con, $sql);
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