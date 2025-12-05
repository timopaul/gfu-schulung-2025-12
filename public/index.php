<?php

declare(strict_types=1);

use App\Controller\ArticleController;
use App\Controller\HomeController;
use App\Router;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . 'vendor/autoload.php';

require_once BASE_PATH . 'src/autoload.php';

require_once BASE_PATH . 'src/functions.php';

// load .env vars
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

// Router initialisieren
$router = new Router();

// Routes definieren
$router->get('/', HomeController::class, 'index');
$router->get('/article/create', ArticleController::class, 'create');
$router->post('/article/create', ArticleController::class, 'create');
$router->get('/article/edit/{id}', ArticleController::class, 'edit');
$router->post('/article/edit/{id}', ArticleController::class, 'edit');
$router->get('/article/delete/{id}', ArticleController::class, 'delete');

// Request verarbeiten
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// strip request URI base path if exists
$parts = parse_url($_ENV['PROJECT_URL']);
$path = $parts['path'] ?? '/';
if ('/' !== $path && str_starts_with($requestUri, $path)) {
    $requestUri = substr($requestUri, strlen($path));
    if ('' === $requestUri) {
        $requestUri = '/';
    }
}

$router->dispatch($requestUri, $requestMethod);
