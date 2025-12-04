<?php

declare(strict_types=1);

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