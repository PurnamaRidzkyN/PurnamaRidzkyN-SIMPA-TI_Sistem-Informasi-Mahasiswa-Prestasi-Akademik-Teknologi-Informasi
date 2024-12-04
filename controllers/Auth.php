<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\models\database\users\User;

class Auth extends BaseController
{
    public function login(Request $req, Response $res): void
    {
        $body = $req->body();
        $username = $body['username'];
        $password = $body(['password']);

        try {
            $user = User::findOne($username)["result"][0];
            if (!$user) {
                $this->view("login/login", ["title" => "Login"]);
                return;
            }
            if (!password_verify($password, $user["password"])) {
                $this->view("login/login", ["title" => "Login"]);
                return;
            }
            Session::set("user", $user["no_induk"]);
            Session::set("role", $user["role"]);
            $res->redirect(getenv("BASE_URL") . "/");
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function renderLogin(): void
    {
        $this->view("login/login", ["title" => "Login"]);
    }
}
