<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;

class Dashboard extends BaseController
{
    public function studentDashboard(Request $req, Response $res): void
    {
        $this->view("dashboard/mahasiswa", "Dashboard Mahasiswa");
    }

    public function adminDashboard(Request $req, Response $res): void
    {
        $this->view("dashboard/admin", "Dashboard Admin");
    }

}