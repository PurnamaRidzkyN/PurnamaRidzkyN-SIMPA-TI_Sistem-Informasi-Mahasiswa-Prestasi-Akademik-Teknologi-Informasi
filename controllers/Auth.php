<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;

class Auth extends BaseController
{
    public function login(Request $req, Response $res): void
    {
        $body = $req->body();
        $username = $body['username'];
        $password = $body(['password']);

        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    }

    public function renderLogin(): void
    {
        $this->view("login/login", ["title" => "Login"]);
    }
}
