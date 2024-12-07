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
        $username = $body["username"];
        $password = $body["password"];


        // handle login logic
        try {
            $user = User::findOne($username)["result"][0];
            if (!$user) {
                $this->view("login/login", "login", ["error" => "user not found"]);
                return;
            }

            if (!password_verify($password, $user["password"])) {
                $this->view("login/login", "login", ["error" => "wrong password"]);
                return;
            }
          
            Session::set("user", $user["username"]);
            Session::set("role", $user["role"]);
            
            // redirect each user to their page
            switch ($user["role"]) {
                case "1":
                    $res->redirect("/dashboard/admin/{$user["username"]}");
                    break;

                case "2":
                    $res->redirect("/dashboard/mahasiswa/{$user["username"]}");
                    break;
                default:
                    $res->redirect("/");
                    break;
            }
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function renderLogin(): void
    {
        $this->view("login/login", "login");
    }

    public function logout(Request $req, Response $res): void
    {
        Session::destroy();
        $res->redirect("/");
    }
}
