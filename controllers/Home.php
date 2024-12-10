<?php

namespace app\controllers;

use app\models\database\prestasiLomba\InfoLomba;
use app\models\database\users\Mahasiswa;

class Home extends BaseController
{
    public function index(): void
    {
        $lomba = InfoLomba::displayInfoLomba();

        $data = Mahasiswa::getLeaderboard();
        $data = ["Info_Lomba" => $lomba, "Leaderboard" => $data];
        $this->view("home/home", "home", $data);
    }
}