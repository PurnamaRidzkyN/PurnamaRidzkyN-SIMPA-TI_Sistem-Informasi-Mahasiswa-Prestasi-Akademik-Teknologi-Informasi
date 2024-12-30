<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\helpers\Dump;
use app\models\database\logData\LogData;
use app\models\database\prestasiLomba\InfoLomba;
use app\models\database\prestasiLomba\JenisLomba;
use app\models\database\prestasiLomba\Peringkat;
use app\models\database\prestasiLomba\Prestasi;
use app\models\database\prestasiLomba\TingkatLomba;
use app\models\database\users\Admin;
use app\models\database\users\Dosen;
use app\models\database\users\Mahasiswa;

class ManagementData extends BaseController
{
    public function renderManagementData(Request $req, Response $res): void
    {
        $body = $req->body();
        $log = LogData::logDataDisplay()["result"];
        if (!is_null($log)){
            usort($log, function($a, $b) {
                // Mengonversi tanggal ke format timestamp untuk perbandingan
                $dateA = strtotime($a['tanggal']);
                $dateB = strtotime($b['tanggal']);
                
                // Mengurutkan dari yang terbaru (descending)
                return $dateB - $dateA;
            });
    
        }
        $admin = Admin::displayAdmin()["result"];
        $mahasiswa = Mahasiswa::displayMahasiswa()["result"];
        $dosen = Dosen::displayDosen()["result"];
        $lomba = InfoLomba::displayInfoLomba()["result"];
        $lomba = array_map(function ($item) {
            if (isset($item['file_poster'])) {
                $item['foto'] = $item['file_poster'];
                unset($item['file_poster']); // Hapus key lama
            }
            return $item;
        }, $lomba);
        $peringkat = Peringkat::displayPeringkat()["result"];
        $tingkatLomba = TingkatLomba::displayTingkatLomba()["result"];
        $jenisLomba = JenisLomba::displayJenisLomba()["result"];


        $data = ["data"=>$body,"admin"=> $admin,"mahasiswa"=>$mahasiswa,"dosen"=>$dosen,"log data"=>$log,"lomba" => $lomba, "peringkat" => $peringkat, "tingkat lomba" => $tingkatLomba, "jenis lomba" => $jenisLomba];
        $this->view("Dashboard/admin/manajemenData/manajemenData", "Manajemen Data", $data);
    }
}
