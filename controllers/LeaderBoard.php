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
    public function renderLeaderboardAll(): void
    {
        $mahasiswa = Mahasiswa::getLeaderboard();

        $mahasiswa = $mahasiswa['result'];
        $this->view("leaderboard/LeaderboardJTI", "Leaderboard", $mahasiswa);
    }

    public function renderLeaderboardSIB(): void
    {
        $mahasiswa = Mahasiswa::getLeaderboard();
        $mahasiswa = $mahasiswa['result'];
        $filteredMahasiswa = [];
        $newRank = 1;

        foreach ($mahasiswa as $mhs) {
            if ($mhs['Program_Studi'] === "Sistem Informasi Bisnis") {
                $mhs['Rank'] = (string)$newRank; // Rank disusun ulang mulai dari 1
                $filteredMahasiswa[] = $mhs; // Tambahkan ke array baru
                $newRank++; // Increment rank
            }
        }

        $this->view("leaderboard/LeaderboardSIB", "Leaderboard", $filteredMahasiswa);
    }
    public function renderLeaderboardTI(): void
    {
        $mahasiswa = Mahasiswa::getLeaderboard();
        $mahasiswa = $mahasiswa['result'];
        $filteredMahasiswa = [];
        $newRank = 1;

        foreach ($mahasiswa as $mhs) {
            if ($mhs['Program_Studi'] === "Teknik Informatika") {
                $mhs['Rank'] = (string)$newRank; // Rank disusun ulang mulai dari 1
                $filteredMahasiswa[] = $mhs; // Tambahkan ke array baru
                $newRank++; // Increment rank
            }
        }

        $this->view("leaderboard/LeaderboardTI", "Leaderboard", $filteredMahasiswa);
    }
}
