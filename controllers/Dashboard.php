<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\helpers\Dump;
use app\models\database\prestasiLomba\InfoLomba;
use app\models\database\users\Admin;
use app\models\database\users\Mahasiswa;
use app\models\database\notifikasi\Notifikasi;
use app\models\database\users\Dosen;

class Dashboard extends BaseController
{
    public function studentDashboard(): void
    {
        $data = InfoLomba::displayInfoLomba();
        $leaderboard = Mahasiswa::getLeaderboard();
        $data = ["info_lomba" => $data, "leaderboard" => $leaderboard];
        $this->view("dashboard/mahasiswa/mahasiswa", "Dashboard Mahasiswa", $data);
    }
    public function DosenDashboard(): void
    {
        $data = InfoLomba::displayInfoLomba();
        $leaderboard = Mahasiswa::getLeaderboard();
        $data = ["info_lomba" => $data, "leaderboard" => $leaderboard];
        $this->view("/dosen/homeDosen", "Dashboard Mahasiswa", $data);
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
    public function renderProfilDosen()
    {
        $data = Dosen::findNidn(Session::get("user"))["result"];
        $this->view("/dosen/profil", "Dashboard Dosen", $data);
    }

    public function renderNotifikasiAdmin()
    {
        $data = Notifikasi::displayNotif()['result'];
        if (is_null($data)){
            $this->view("dashboard/notif","Notifikasi");

        }
        $notif = array_filter($data, function($item) {
            return ($item['id_user'] === null) && $item['role'] === '1';
        });    
        usort($notif, function($a, $b) {
            // Mengonversi tanggal ke format timestamp untuk perbandingan
            $dateA = strtotime($a['dibuat']);
            $dateB = strtotime($b['dibuat']);
            
            // Mengurutkan dari yang terbaru (descending)
            return $dateB - $dateA;
        });
          
        $this->view("dashboard/notif","Notifikasi",$notif);
    }
    
    public function renderNotifikasiMahasiswa()
    {
        $data = Notifikasi::displayNotif()['result'];
        if (is_null($data)){
            $this->view("dashboard/notif","Notifikasi");

        }
        $notif = array_filter($data, function($item) {
            return ($item['id_user'] === null)||($item['id_user'] === Mahasiswa::findNim(Session::get("user"))['result'][0]['id_user']) && $item['role'] === '2';
        }); 
        usort($notif, function($a, $b) {
            // Mengonversi tanggal ke format timestamp untuk perbandingan
            $dateA = strtotime($a['dibuat']);
            $dateB = strtotime($b['dibuat']);
            
            // Mengurutkan dari yang terbaru (descending)
            return $dateB - $dateA;
        });
        
        $this->view("dashboard/notif","Notifikasi",$notif);
    }
}
