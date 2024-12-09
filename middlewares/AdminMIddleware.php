<?php

namespace app\middlewares;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\models\database\users\Admin;

class AdminMiddleware implements Middleware
{
    public function before(Request $req, Response $res): void
    {
        if (Session::get("role") !== "1") {
            $res->redirect("/login");
            return;
        }

        $admin = Admin::findNip(Session::get("user"));
        $nip = $admin["result"][0]["nip"];

        if ($req->getParams("nip") !== $nip) {
            $res->redirect("/login");
        }
    }
}
