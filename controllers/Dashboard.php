<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\models\database\prestasiLomba\InfoLomba;

class Dashboard extends BaseController
{
    public function studentDashboard(): void
    {
        $data = InfoLomba::displayInfoLomba();
        $data = $data["result"];
        $this->view("dashboard/mahasiswa/mahasiswa", "Dashboard Mahasiswa",$data);
    }

    public function adminDashboard(): void
    {
        $this->view("dashboard/admin/admin", "Dashboard Admin");
    }

}