<?php

declare(strict_types=1);

use Smarty\Smarty;
use Smarty\Exception as SmartyException;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . 'vendor/autoload.php';
require_once BASE_PATH . 'src/functions.php';
require_once BASE_PATH . 'src/constants.php';

// load .env vars
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$smarty = new Smarty();
$smarty->setTemplateDir(BASE_PATH . 'templates/default');
$smarty->setCompileDir(BASE_PATH . 'cache/compile');
$smarty->setCacheDir(BASE_PATH . 'cache/templates');

if (filter_has_var(INPUT_GET, 'id')) {
    $id = (int) filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $article = getArticleById($id);

    $smarty->assign('values', $article);
}

if (isPostRequest()) {

    $isEditForm = filter_has_var(INPUT_POST, 'id');

    $errors = [];

    $title = $_POST['title'] ?? '';
    if ('' === trim($title)) {
        $errors['title'] = 'Der Titel darf nicht leer sein.';
    }

    $text = $_POST['text'] ?? '';
    if ('' === trim($text)) {
        $errors['text'] = 'Der Text darf nicht leer sein.';
    }

    $authorId = $_POST['author_id'] ?? '';
    if ('' === trim($authorId) || ! is_numeric($authorId)) {
        $errors['author_id'] = 'Es muss ein gültiger Autor ausgewählt werden.';
    }

    $status = $_POST['status'] ?? 'draft';

    if (0 === count($errors)) {

        if ($isEditForm) {
            $id = (int) filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if (updateArticle($id, $title, $text, (int) $authorId, $status)) {
                redirectTo('index.php');
            }
            $errors['general'] = 'Beim Aktualisieren des Artikels ist ein Fehler aufgetreten.';
        } elseif (insertArticle($title, $text, (int) $authorId, $status)) {
            redirectTo('index.php');
        }
        $errors['general'] = 'Beim Speichern des Artikels ist ein Fehler aufgetreten.';
    }

    $values = [
        'title' => $title,
        'text' => $text,
        'author_id' => $authorId,
        'status' => $status,
    ];
    if ($isEditForm) {
        $values['id'] = (int) filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    }
    $smarty->assign('values', $values);
    $smarty->assign('errors', $errors);
}

$authors = getAuthors();
$smarty->assign('authors', $authors);

try {
    $smarty->display('form.tpl');
} catch (SmartyException $e) {
    if ('development' == $_ENV['ENVIRONMENT']) {
        throw $e;
    } else {
        echo 'Es ist ein Fehler aufgetreten.';
    }
} catch (Exception $e) {
    echo 'Es ist ein unerwarteter Fehler aufgetreten.';
}
