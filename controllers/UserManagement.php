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

        Dump::out($body);
        exit;
        $name = $body['nama'];
        $nim = $body['nim'];
        $prodi = $body['prodi'];
        $jurusan = $body['jurusan'];
        $tahun_masuk = $body['tahun_masuk'];
        $foto = $body['photo'];
        $email = $body['email'];
        $user = User::findOne($nim);
        try {
            $fileFoto = FileUpload::uploadFile($foto, FileUpload::TARGET_DIR_FOTO_PROFILE);
            if (!isset($user["result"])) {
                $this->view("dashboard/admin/manajemenData/mahasiswaData", "list mahasiswa",[ "error" => "nim sudah digunakan"]);
                var_dump("hehe");
                return;
            
            }
            $userData = [
                "id" => UUID::generate("[user]", "U"),
                "username" => $nim,
                "password" => password_hash($nim, PASSWORD_BCRYPT),
                "role" => 2
            ];
            User::insert($userData);
    
            $Data = ArrayFormatter::formatKeyValue($userData);
    
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $userData[User::ID],
                User::TABLE,
                "insert",
                "null",
                "null",
                $Data
            );
    
            $dataMahasiswa = [
                Mahasiswa::ID => UUID::generate(Mahasiswa::TABLE, "M"),
                Mahasiswa::ID_USER => $userData["id"],
                Mahasiswa::NIM => $nim,
                Mahasiswa::NAMA => $name,
                Mahasiswa::PRODI => $prodi,
                Mahasiswa::JURUSAN => $jurusan,
                Mahasiswa::TAHUN_MASUK => $tahun_masuk,
                Mahasiswa::FOTO => $fileFoto,
                Mahasiswa::EMAIL => $email,
            ];
            Mahasiswa::insert($dataMahasiswa);
    
            $data = ArrayFormatter::formatKeyValue($dataMahasiswa);
            
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $dataMahasiswa[Mahasiswa::ID],
                Mahasiswa::TABLE,
                "insert",
                "null",
                "null",
                $data
            );
    
            $res->redirect("/dashboard/admin/{$Admin['result'][0]["nip"]}/mahasiswa-data");
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
        $foto = $body['fotoProfil'];
    
        try {
            $fileFoto = FileUpload::uploadFile($foto, FileUpload::TARGET_DIR_FOTO_PROFILE);
    
            $userData = [
                "id" => UUID::generate("[user]", "U"),
                "username" => $nidn,
                "password" => password_hash($nidn, PASSWORD_BCRYPT),
                "role" => 3
            ];
            User::insert($userData);
    
            $Data = ArrayFormatter::formatKeyValue($userData);
    
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $userData[User::ID],
                User::TABLE,
                "insert",
                "null",
                "null",
                $Data
            );
    
            $dataDosen = [
                Dosen::ID => UUID::generate(Dosen::TABLE, "D"),
                Dosen::ID_USER => $userData["id"],
                Dosen::NIDN => $nidn,
                Dosen::NAMA => $name,
                Dosen::FOTO => $fileFoto,
                Dosen::EMAIL => $email,
            ];
            Dosen::insert($dataDosen);
    
            $data = ArrayFormatter::formatKeyValue($dataDosen);
    
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $dataDosen[Dosen::ID],
                Dosen::TABLE,
                "insert",
                "null",
                "null",
                $data
            );
    
            $res->redirect("/dashboard/admin/{$Admin['result'][0]["nip"]}/dosen-data");
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    

}
