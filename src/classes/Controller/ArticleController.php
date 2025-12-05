<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enums\Status;
use App\Manager\ArticleManager;
use App\Manager\AuthorManager;

class ArticleController extends BaseController
{
    public function create(): void
    {
        if ($this->isPostRequest()) {
            $this->handleFormSubmit(false);
            return;
        }

        $authors = AuthorManager::getInstance()->getAll();

        $this->render('form.tpl', [
            'authors' => $authors,
            'form_action' => $_ENV['PROJECT_URL'] . '/article/create',
        ]);
    }

    public function edit(string $id): void
    {
        $articleId = (int) $id;
        $article = ArticleManager::getInstance()->getOne($articleId);

        if (null === $article) {
            $this->redirect('/?error=2');
            return;
        }

        if ($this->isPostRequest()) {
            $this->handleFormSubmit(true);
            return;
        }

        $authors = AuthorManager::getInstance()->getAll();

        $this->render('form.tpl', [
            'values' => $article,
            'authors' => $authors,
            'form_action' => $_ENV['PROJECT_URL'] . '/article/edit/' . $id,
        ]);
    }

    public function delete(string $id): void
    {
        $articleId = (int) $id;
        $article = ArticleManager::getInstance()->getOne($articleId);

        if (null === $article) {
            $this->redirect('/?error=2');
            return;
        }

        if (ArticleManager::getInstance()->delete($articleId)) {
            $this->redirect('/?success=1');
        } else {
            $this->redirect('/?error=1');
        }
    }

    private function handleFormSubmit(bool $isEdit): void
    {
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
        if ('' === trim($authorId) || !is_numeric($authorId)) {
            $errors['author_id'] = 'Es muss ein gültiger Autor ausgewählt werden.';
        }

        $status = $_POST['status'] ?? Status::draft->name;

        $cases = Status::cases();
        $isValid = false;
        foreach ($cases as $case) {
            if ($case->name === $status) {
                $isValid = true;
                break;
            }
        }
        if (false === $isValid) {
            $errors['status'] = 'Es muss ein gültiger Status ausgewählt werden.';
        }

        if (0 === count($errors)) {
            if ($isEdit) {
                $id = (int) filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                if (ArticleManager::getInstance()->update($id, $title, $text, (int) $authorId, $status)) {
                    $this->redirect('/');
                }
                $errors['general'] = 'Beim Aktualisieren des Artikels ist ein Fehler aufgetreten.';
            } elseif (ArticleManager::getInstance()->insert($title, $text, (int) $authorId, $status)) {
                $this->redirect('/');
            } else {
                $errors['general'] = 'Beim Speichern des Artikels ist ein Fehler aufgetreten.';
            }
        }

        $values = [
            'title' => $title,
            'text' => $text,
            'author_id' => $authorId,
            'status' => $status,
        ];
        if ($isEdit) {
            $values['id'] = (int) filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        }

        $authors = AuthorManager::getInstance()->getAll();
        $formAction = $isEdit ? '/article/edit/' . $values['id'] : '/article/create';

        $this->render('form.tpl', [
            'values' => $values,
            'errors' => $errors,
            'authors' => $authors,
            'form_action' => $_ENV['PROJECT_URL'] . $formAction,
        ]);
    }

    function view(string $id): void
    {
        $articleId = (int) $id;
        $article = ArticleManager::getInstance()->getOne($articleId);

        if (null === $article) {
            $this->redirect('/?error=2');
            return;
        }

        $author = AuthorManager::getInstance()->getOne((int) $article['author_id']);

        $this->render('view.tpl', [
            'article' => $article,
            'paragraphs' => explode("\n", $article['text']),
            'author' => $author,
        ]);
    }
}

