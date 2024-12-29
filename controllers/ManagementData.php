<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\helpers\Dump;
use app\models\database\logData\LogData;
use app\models\database\users\Admin;
use app\models\database\users\Mahasiswa;
use app\models\database\users\Dosen;

class ManagementData extends BaseController
{
    public function manageData(Request $req, Response $res)
    {
        $body = $req->body();
        $user = Admin::findNip(Session::get("user")); // Identifikasi admin yang sedang login

        // Logika berdasarkan aksi yang diminta
        switch ($body["action"]) {
            case "add":
                $this->addUser($body);
                break;
            case "delete":
                $this->deleteUser($body);
                break;
            case "update":
                $this->updateUser($body);
                break;
            default:
                Dump::out("Aksi tidak valid");
        }

        // Panggil fungsi render untuk menampilkan data management
        $this->renderManagementData();
    }

    private function addUser($body)
    {
        if ($body["data"] === "admin") {
            Admin::insert($body["details"]);
        } elseif ($body["data"] === "mahasiswa") {
            Mahasiswa::insert($body["details"]);
        } elseif ($body["data"] === "dosen") {
            Dosen::insert($body["details"]);
        }
    }

    private function deleteUser($body)
    {
        if ($body["data"] === "admin") {
            Admin::deleteData($body["id"]);
        } elseif ($body["data"] === "mahasiswa") {
            Mahasiswa::deleteData($body["id"]);
        } elseif ($body["data"] === "dosen") {
            Dosen::deleteData($body["id"]);
        }
    }

    private function updateUser($body)
    {
        if ($body["data"] === "admin") {
            Admin::updateData($body["id"], $body["details"]);
        } elseif ($body["data"] === "mahasiswa") {
            Mahasiswa::updateData($body["id"], $body["details"]);
        } elseif ($body["data"] === "dosen") {
            Dosen::updateData($body["id"], $body["details"]);
        }
    }

    /**
     * Fungsi untuk menampilkan data management pada view
     */
    public function renderManagementData(): void
    {
        // Ambil data dari model
        $log = LogData::logDataDisplay()["result"];
        $admin = Admin::displayAdmin()["result"];
        $mahasiswa = Mahasiswa::displayMahasiswa()["result"];
        $dosen = Dosen::displayDosen()["result"];

        // Gabungkan data ke dalam array
        $data = [
            "admin" => $admin,
            "mahasiswa" => $mahasiswa,
            "dosen" => $dosen,
            "log_data" => $log,
        ];

        // Panggil view untuk menampilkan data
        $this->view("dashboard/admin/manajemenData/manajemenData", "Management Data", $data);
    }
}
