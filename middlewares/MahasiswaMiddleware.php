<?php
namespace app\middlewares;
use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
class StudentMiddleware implements Middleware
{
    public function before(Request $req, Response $res): void
    {
        if (Session::get("role") !== "student") {
            $res->redirect("/login");
        }
    }
}