<?php

declare(strict_types=1);

use App\Manager\ArticleManager;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . 'vendor/autoload.php';
require_once BASE_PATH . 'src/autoload.php';
require_once BASE_PATH . 'src/functions.php';

// load .env vars
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

if ( ! filter_has_var(INPUT_GET, 'id')) {
    redirectTo('index.php?error=3');
}

$id = (int) filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$article = ArticleManager::getInstance()->getOne($id);

if (null === $article) {
    redirectTo('index.php?error=2');
}

if (ArticleManager::getInstance()->delete($id)) {
    redirectTo('index.php?success=1');
} else {
    redirectTo('index.php?error=1');
}