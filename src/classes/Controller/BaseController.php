<?php

declare(strict_types=1);

namespace App\Controller;

use Smarty\Exception as SmartyException;
use Smarty\Smarty;

abstract class BaseController
{
    protected Smarty $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(BASE_PATH . 'templates/default');
        $this->smarty->setCompileDir(BASE_PATH . 'cache/compile');
        $this->smarty->setCacheDir(BASE_PATH . 'cache/templates');
    }

    protected function render(string $template, array $data = []): void
    {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        try {
            $this->smarty->display($template);
        } catch (SmartyException $e) {
            if ('development' == $_ENV['ENVIRONMENT']) {
                throw $e;
            }
            echo 'Es ist ein Fehler aufgetreten.';
        } catch (\Exception $e) {
            echo 'Es ist ein unerwarteter Fehler aufgetreten.';
        }
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $_ENV['PROJECT_URL'] . $url);

        exit;
    }

    protected function isPostRequest(): bool
    {
        return 'POST' === $_SERVER['REQUEST_METHOD'];
    }
}
