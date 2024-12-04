<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\View;

class BaseController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function view(string $viewPath, string $title, array $data = []): void
    {
        $this->view->render($viewPath, $title, $data);
    }
}