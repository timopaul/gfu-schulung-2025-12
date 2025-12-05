<?php

declare(strict_types=1);

namespace App\Controller;

use App\Manager\ArticleManager;

class HomeController extends BaseController
{
    public function index(): void
    {
        $articles = ArticleManager::getInstance()->getAll();

        $this->render('list.tpl', [
            'articles' => $articles,
        ]);
    }
}

