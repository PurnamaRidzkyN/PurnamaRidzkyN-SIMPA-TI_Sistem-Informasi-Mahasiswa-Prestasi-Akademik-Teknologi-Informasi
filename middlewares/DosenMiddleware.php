<?php

namespace app\middlewares;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\models\database\users\Dosen;

class DosenMiddleware implements Middleware
{
    public function before(Request $req, Response $res): void
    {
        if (Session::get("role") !== "1") {
            $res->redirect("/login");
            return;
        }

        $admin = Dosen::findNidn(Session::get("user"));
        $nip = $admin["result"][0]["nidn"];

        if ($req->getParams("nip") !== $nip) {
            $res->redirect("/login");
        }
    }
}
