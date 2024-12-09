<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\models\database\prestasiLomba\InfoLomba;
use app\helpers\UUID;

class InfoLombaController extends BaseController
{
    public function createLomba(Request $req, Response $res): void
    {
        $body = $req->body();
        $data = [
            InfoLomba::ID => UUID::generate("info_lomba", "LMB"),
            InfoLomba::JUDUL => $body["judul"],
            InfoLomba::DESKRIPSI_LOMBA => $body["deskripsi"],
            InfoLomba::TANGGAL_AKHIR_PENDAFTARAN => $body["tanggal_akhir_pendaftaran"],
            InfoLomba::LINK_PERLOMBAAN => $body["link"],
            InfoLomba::FILE_POSTER => $body["file_poster"]
        ];

        try {
            $result = InfoLomba::insert($data);
            if ($result["success"]) {
                $res->redirect("/info-lomba");
            } else {
                $this->view("infoLomba/create", "Create Lomba", ["error" => "Gagal membuat lomba"]);
            }
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function viewAllLomba(): void
    {
        $infoLomba = InfoLomba::getAll();
        $this->view("infoLomba/index", "Daftar Lomba", ["infoLomba" => $infoLomba]);
    }

    public function deleteAllLomba(Request $req, Response $res): void
    {
        try {
            $result = InfoLomba::deleteAll();
            if ($result["success"]) {
                $res->redirect("/info-lomba");
            } else {
                $this->view("infoLomba/index", "Daftar Lomba", ["error" => "Gagal menghapus semua lomba"]);
            }
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function renderViewLomba(): void
    {
        $this->view("dashboard/infoLomba/viewLomba", "Daftar Lomba");
    }

    public function renderCreateLomba(): void
    {
        $this->view("dashboard/infoLomba/create", "Upload Lomba");
    }

    public function renderHapusLomba(): void
    {
        $this->view("dashboard/infoLomba/delete", "Hapus Lomba");
    }

}
