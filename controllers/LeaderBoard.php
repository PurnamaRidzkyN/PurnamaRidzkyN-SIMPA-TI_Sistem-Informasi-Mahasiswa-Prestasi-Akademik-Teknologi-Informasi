<?php

namespace app\controllers;

use app\helpers\Dump;
use app\models\database\users\Mahasiswa;
use app\models\database\prestasiLomba\Peringkat;
use app\models\database\users\Admin;

class Leaderboard extends BaseController
{
    /**
     * Menampilkan leaderboard mahasiswa berdasarkan total skor.
     *
     * @return array
     */
    public function renderLeaderboard(): void
    {
        $this->view("leaderboard/Leaderboard", "Leaderboard");
    }
    public function renderLeaderboardAll() : void {
        $mahasiswa = Mahasiswa::getLeaderboard();

        $mahasiswa = $mahasiswa['result'];
        $this->view("leaderboard/LeaderboardJTI", "Leaderboard", $mahasiswa);
        
    }

    public function renderLeaderboardSIB() : void {
        $mahasiswa = Mahasiswa::getLeaderboardSIB();

        $mahasiswa = $mahasiswa['result'];
        $this->view("leaderboard/LeaderboardSIB", "Leaderboard", $mahasiswa);
        
    }
}