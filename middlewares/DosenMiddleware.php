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
        if (Session::get("role") !== "3") {
            $res->redirect("/login");
            return;
        }

        $Dosen = Dosen::findNidn(Session::get("user"));
        $nidn = $Dosen["result"][0]["nidn"];

        if ($req->getParams("nidn") !== $nidn) {
            $res->redirect("/login");
        }
    }
}
