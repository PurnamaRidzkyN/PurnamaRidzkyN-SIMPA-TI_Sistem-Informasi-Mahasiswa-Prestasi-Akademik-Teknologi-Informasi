<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\helpers\Dump;
use app\helpers\UUID;
use app\models\database\logData\LogData;
use app\models\database\users\Admin;
use app\models\database\users\Dosen;
use app\models\database\users\Mahasiswa;
use app\models\database\users\User;
use app\helpers\ArrayFormatter;
use app\helpers\FileUpload;

class UserManagement extends BaseController
{
    public function insertAdminUsers(Request $req, Response $res)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $body = $req->body();
        $name = $body['name'];
        $email = $body['email'];
        $foto = $body['photo'];
        $nip = $body['nip'];

        try {

            $fileFoto = FileUpload::uploadFile($foto, FileUpload::TARGET_DIR_FOTO_PROFILE);
            
            $userData = [
                "id" => UUID::generate("[user]", "U"),
                "username" => $nip,
                "password" => password_hash($nip, PASSWORD_BCRYPT),
                "role" => 1
            ];
            User::insert($userData);
            
            $Data = ArrayFormatter::formatKeyValue($userData);
            
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $userData[User::ID],
                Admin::TABLE,
                "insert",
                "null",
                "null",
                $Data
            );

            $dataAdmin =[
                Admin::ID => UUID::generate(Admin::TABLE, "A"),
                Admin::ID_USER => $userData["id"],
                Admin::NIP => $nip,
                Admin::NAMA => $name,
                Admin::FOTO => $fileFoto,
                Admin::EMAIL => $email,
            ];
            Admin::insert($dataAdmin);
        
            $data = ArrayFormatter::formatKeyValue($dataAdmin);

            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $dataAdmin["id"],
                Admin::TABLE,
                "insert",
                "null",
                "null",
                $data
            );
            $res->redirect("/dashboard/admin/{$Admin['result'][0]["nip"]}/admin-data");
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    public function insertMahasiswaUsers(Request $req, Response $res)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $body = $req->body();
        $name = $body['nama'];
        $nim = $body['nim'];
        $prodi = $body['prodi'];
        $jurusan = $body['jurusan'];
        $tahun_masuk = $body['tahun_masuk'];
        $foto = $body['fotoProfil'];
        $email = $body['email'];

        try {
            $fileFoto = FileUpload::uploadFile($foto, FileUpload::TARGET_DIR_FOTO_PROFILE);

            $userData = User::insert([
                "id" => UUID::generate(User::TABLE, "U"),
                "username" => $nim,
                "password" => password_hash($nim, PASSWORD_BCRYPT),
                "role" => 2
            ]);
            $userData = ArrayFormatter::formatKeyValue($userData);

            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $userData[User::ID],
                User::TABLE,
                "insert",
                "null",
                "null",
                $userData
            );

            $dataMahasiswa = Mahasiswa::insert([
                Mahasiswa::ID => UUID::generate(Mahasiswa::TABLE, "M"),
                Mahasiswa::ID_USER => $userData["id"],
                Mahasiswa::NIM => $nim,
                Mahasiswa::NAMA => $name,
                Mahasiswa::PRODI => $prodi,
                Mahasiswa::JURUSAN => $jurusan,
                Mahasiswa::TAHUN_MASUK => $tahun_masuk,
                Mahasiswa::FOTO => $foto,
                Mahasiswa::EMAIL => $email,
            ]);

            $dataMahasiswa = ArrayFormatter::formatKeyValue($dataMahasiswa);

            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $dataMahasiswa['result'][0]["id_user"],
                Mahasiswa::TABLE,
                "insert",
                "null",
                "null",
                $dataMahasiswa
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function insertDosenUsers(Request $req, Response $res)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $body = $req->body();
        $name = $body['nama'];
        $nidn = $body['nidn'];
        $email = $body['email'];

        try {

            $userData = User::insert([
                "id" => UUID::generate(User::TABLE, "U"),
                "username" => $nidn,
                "password" => password_hash($nidn, PASSWORD_BCRYPT),
                "role" => 3 // Assuming role 3 is for dosen
            ]);
            $userData = ArrayFormatter::formatKeyValue($userData);

            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $userData[User::ID],
                User::TABLE,
                "insert",
                "null",
                "null",
                $userData
            );

            $dataDosen = Dosen::insert([
                Dosen::ID => UUID::generate(Dosen::TABLE, "D"),
                Dosen::ID_USER => $userData["id"],
                Dosen::NIDN => $nidn,
                Dosen::NAMA => $name,
            ]);

            $dataDosen = ArrayFormatter::formatKeyValue($dataDosen);

            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $dataDosen['result'][0]["id_user"],
                Dosen::TABLE,
                "insert",
                "null",
                "null",
                $dataDosen
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function renderDataAdmin()
    {
        $data = Admin::displayAdmin();
        $dataAdmin = $data["result"];
        $this->view("dashboard/admin/manajemenData/adminData", "Admin Data", $dataAdmin);
    }
    public function renderDataMahasiswa()
    {
        $data = Mahasiswa::displayMahasiswa();
        $dataMahasiswa = $data["result"];
        $this->view("dashboard/admin/manajemenData/mahasiswaData", "list mahasiswa", $dataMahasiswa);
    }

    public function renderDataDosen()
    {
        $data = Dosen::displayDosen();
        $dataDosen = $data["result"];
        $this->view("dashboard/admin/manajemenData/dosenData", "list dosen", $dataDosen);
    }
}
