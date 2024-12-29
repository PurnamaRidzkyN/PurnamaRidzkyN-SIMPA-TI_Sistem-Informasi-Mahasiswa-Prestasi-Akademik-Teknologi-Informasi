<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\models\database\prestasiLomba\InfoLomba;
use app\models\database\users\Admin;
use app\models\database\users\Mahasiswa;
use app\models\database\users\Notifikasi;

class Dashboard extends BaseController
{
    public function studentDashboard(): void
    {
        $data = InfoLomba::displayInfoLomba();
        $leaderboard = Mahasiswa::getLeaderboard();
        $data = ["info_lomba" => $data, "leaderboard" => $leaderboard];
        $this->view("dashboard/mahasiswa/mahasiswa", "Dashboard Mahasiswa", $data);
    }

    public function adminDashboard(): void
    {
        $data = InfoLomba::displayInfoLomba();
        $leaderboard = Admin::getLeaderboard();
        $data = ["info_lomba" => $data, "leaderboard" => $leaderboard];
        $this->view("dashboard/admin/admin", "Dashboard Admin", $data);
    }

    public function renderProfilAdmin()
    {
        $data = Admin::findNip(Session::get("user"))["result"];
        $this->view("dashboard/admin/profil", "Dashboard Admin", $data);
    }
    public function renderProfilMahasiswa()
    {
        $data = Mahasiswa::findNim(Session::get("user"))["result"];
        $this->view("dashboard/mahasiswa/profil", "Dashboard Mahasiswa", $data);
    }

    public function renderNotifikasiAdmin()
    {
        $this->view("dashboard/notif","Notifikasi");
    }
    
    public function renderNotifikasiMahasiswa()
    {
        $this->view("dashboard/notif","Notifikasi",);
    }
}
