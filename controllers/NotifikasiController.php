<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\helpers\Dump;
use app\models\database\notifikasi\Notifikasi;
use app\models\database\users\Admin;
use app\models\database\users\Mahasiswa;

class NotifikasiController extends BaseController
{
    public function deleteNotifikasi(Request $req, Response $res): void
    {
        $user = Session::get("user");
        $body = $req->body();
        $id = $body["id"];
        try {
            Notifikasi::deleteNotifikasi($id);
            if (Session::get("role") == "1") {

                $res->redirect(" /dashboard/admin/{$user}/notifikasi");
            } else {
                $res->redirect(" /dashboard/mahasiswa/{$user}/notifikasi");
            }
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function changeStatusNotifikasi(Request $req, Response $res): void
    {
        $user = Session::get("user");
        $body = $req->body();
        $id = $body["id"];
        try {
            Notifikasi::updateNotif($id);
            if (Session::get("role") == "1") {

                $res->redirect(" /dashboard/admin/{$user}/notifikasi");
            } else {
                $res->redirect(" /dashboard/mahasiswa/{$user}/notifikasi");
            }
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
