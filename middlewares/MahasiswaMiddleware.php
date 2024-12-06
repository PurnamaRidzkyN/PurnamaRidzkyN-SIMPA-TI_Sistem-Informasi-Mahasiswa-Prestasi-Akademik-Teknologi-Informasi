<?php

namespace app\middlewares;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\models\database\users\Mahasiswa;
use app\models\database\users\Student;

class StudentMiddleware implements Middleware
{
    public function before(Request $req, Response $res): void
    {
        if (Session::get("role") !== "2") {
            $res->redirect("/login");
            return;
        }

        $student = Mahasiswa::findNim(Session::get("user"));
        $nim = $student["result"][0]["nim"];

        if ($req->getParams("nim") !== $nim) {
            $res->redirect("/404.html");
        }
    }
}