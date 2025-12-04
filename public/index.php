<?php

declare(strict_types=1);

use Smarty\Smarty;
use Smarty\Exception as SmartyException;

const BASE_PATH = __DIR__ . '/../';
        
require_once BASE_PATH . 'vendor/autoload.php';
require_once BASE_PATH . 'src/functions.php';

// load .env vars
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$smarty = new Smarty();
$smarty->setTemplateDir(BASE_PATH . 'templates/default');
$smarty->setCompileDir(BASE_PATH . 'cache/compile');
$smarty->setCacheDir(BASE_PATH . 'cache/templates');

$articles = getArticles();

$smarty->assign('articles', $articles);

try {
    $smarty->display('list.tpl');
} catch (SmartyException $e) {
    if ('development' == $_ENV['ENVIRONMENT']) {
        throw $e;
    } else {
        echo 'Es ist ein Fehler aufgetreten.';
    }
} catch (Exception $e) {
    echo 'Es ist ein unerwarteter Fehler aufgetreten.';
}

