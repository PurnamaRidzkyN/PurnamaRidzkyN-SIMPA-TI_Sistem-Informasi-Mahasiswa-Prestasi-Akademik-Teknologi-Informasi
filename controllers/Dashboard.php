<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\models\database\prestasiLomba\InfoLomba;
use app\models\database\users\Admin;
use app\models\database\users\Mahasiswa;

class Dashboard extends BaseController
{
    public function studentDashboard(): void
    {
        $data = InfoLomba::displayInfoLomba();
        $leaderboard = Mahasiswa::getLeaderboard();
        $data = ["info_lomba" => $data, "leaderboard" => $leaderboard];
        $this->view("dashboard/mahasiswa/mahasiswa", "Dashboard Mahasiswa",$data);
    }

    public function adminDashboard(): void
    {
        $data = InfoLomba::displayInfoLomba();
        $leaderboard = Admin::getLeaderboard();
        $data = ["info_lomba" => $data, "leaderboard" => $leaderboard];
        $this->view("dashboard/admin/admin", "Dashboard Admin", $data);
    }

}