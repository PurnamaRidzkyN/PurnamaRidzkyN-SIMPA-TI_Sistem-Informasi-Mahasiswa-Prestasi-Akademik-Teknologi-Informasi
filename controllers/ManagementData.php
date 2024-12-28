<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\helpers\Dump;
use app\models\database\logData\LogData;
use app\models\database\users\Admin;
use app\models\database\users\Dosen;
use app\models\database\users\Mahasiswa;

class ManagementData extends BaseController
{
    public function renderManagementData(Request $req, Response $res): void
    {
        $body = $req->body();
        $log = LogData::logDataDisplay()["result"];
        $admin = Admin::displayAdmin()["result"];
        $this->view("Dashboard/admin/manajemenData/manajemenData", "Manajemen Data", [
            "adminData" => $admin
        ]);
        $mahasiswa = Mahasiswa::displayMahasiswa()["result"];
        $dosen = Dosen::displayDosen()["result"];

        $data = ["data"=>$body,"admin"=> $admin,"mahasiswa"=>$mahasiswa,"dosen"=>$dosen,"log data"=>$log];
        $this->view("Dashboard/admin/manajemenData/manajemenData", "Manajemen Data", $data);
    }
}
