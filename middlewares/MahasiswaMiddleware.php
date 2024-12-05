<?php
namespace app\middlewares;
use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
class StudentMiddleware implements Middleware
{
    public function before(Request $req, Response $res): void
    {

        var_dump("ini roleku nrooooooooooooooooo".Session::get("role"));
        if (Session::get("role") !== 2) {
            $res->redirect("/login");
        }
    }
}