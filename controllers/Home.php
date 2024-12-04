<?php

namespace app\controllers;

class Home extends BaseController
{
    public function index(): void
    {
        $this->view("home/home", "home");
    }
}