<?php
namespace app\middlewares;
use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
class AdminMiddleware implements Middleware
{
    public function before(Request $req, Response $res): void
    {
        if (Session::get("role") !== "admin") {
            $res->redirect("/login");
        }
    }
}