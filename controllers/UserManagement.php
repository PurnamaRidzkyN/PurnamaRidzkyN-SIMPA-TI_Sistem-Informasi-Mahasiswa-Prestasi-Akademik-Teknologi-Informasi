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

    public function manageData(Request $req, Response $res)
    {
        $body = $req->body();
        if ($body["action"] === "add") {
            if ($body["data"] === "admin") {
                $this->insertAdminUsers($body);
            } else if ($body["data"] === "mahasiswa") {
                $this->insertMahasiswaUsers($body);
            } else if ($body["data"] === "dosen") {
                $this->insertDosenUsers($body);
            }
        } else if ($body["action"] === "update") {
            if ($body["data"] === "admin") {
                $this->updateDataAdmin($body);
            } else if ($body["data"] === "mahasiswa") {
            } else if ($body["data" === "dosen"]) {
            }
        } else if (!is_null($body["delete"])) {
            if ($body["data"] === "admin") {
                Admin::deleteData($body["delete"]);
            } else if ($body["data"] === "mahasiswa") {
                Mahasiswa::deleteData($body["delete"]);
            } else if ($body["data" === "dosen"]) {
                Dosen::deleteData($body["delete"]);
            }
        }
    }
    public function insertAdminUsers(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $name = $body['nama'];
        $email = $body['email'];
        $foto = $body['foto'];
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

            $dataAdmin = [
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
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    public function insertMahasiswaUsers(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
 
        $name = $body['nama'];
        $nim = $body['nim'];
        $prodi = $body['prodi'];
        $jurusan = $body['jurusan'];
        $tahun_masuk = $body['tahun_masuk'];
        $foto = $body['foto'];
        $email = $body['email'];
        $user = User::findOne($nim);
        try {
            $fileFoto = FileUpload::uploadFile($foto, FileUpload::TARGET_DIR_FOTO_PROFILE);

            if (!is_null($user["result"])) {
                $this->view("dashboard/admin/manajemenData", "Manajemen Data", ["error" => "nim sudah digunakan"]);
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
                Mahasiswa::NAMA => $name,
                Mahasiswa::NIM => $nim,
                Mahasiswa::PRODI => $prodi,
                Mahasiswa::JURUSAN => $jurusan,
                Mahasiswa::TAHUN_MASUK => $tahun_masuk,
                Mahasiswa::TOTAL_SKOR => 0,
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
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function insertDosenUsers(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $name = $body['nama'];
        $nidn = $body['nidn'];
        $email = $body['email'];
        $foto = $body['foto'];

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
                Dosen::EMAIL => $email,
                Dosen::FOTO => $fileFoto,

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
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    public function updateDataAdmin(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['id'];
        $id_user = $body['id_user'];
        $name = $body['nama'];
        $email = $body['email'];
        $foto = $body['foto'];
        $nip = $body['nip'];

        try {
            // Validasi data lama
            $oldData = Admin::findNip($nip)['result'][0];
            // Proses foto
            if (isset($foto['type']) && !is_null($foto['type'])) {
                $fileFoto = FileUpload::uploadFile($foto, FileUpload::TARGET_DIR_FOTO_PROFILE);
            } else {
                $fileFoto = $oldData['foto'];
            }

            // Data baru
            $newData = [
                Admin::ID => $id,
                Admin::NIP => $nip,
                Admin::NAMA => $name,
                Admin::FOTO => $fileFoto,
                Admin::EMAIL => $email,
            ];

            // Identifikasi kolom yang diubah
            $differences = [];

            foreach ($newData as $key => $newValue) {
                $oldValue = $oldData[$key] ?? null; // Ambil nilai lama, default ke null jika tidak ada
                if ($oldValue !== $newValue) {
                    $differences[] = [
                        'column' => $key,
                        'old_value' => $oldValue,
                        'new_value' => $newValue,
                    ];
                }
            }

            $columns = [];
            $oldValues = [];
            $newValues = [];

            // Iterasi tanpa membawa indeks
            foreach ($differences as $difference) {
                $columns[] = $difference['column'];
                $oldValues[] = $difference['old_value'];
                $newValues[] = $difference['new_value'];
            }
            
            $columns = implode(', ', $columns);
            $oldValues = implode(', ', $oldValues);
            $newValues = implode(', ', $newValues);

            Dump::out($columns);

            Admin::updateData($newData);

            // Masukkan log
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                Admin::TABLE,
                "update",
                $columns, // Catat kolom yang berubah
                $oldValues,
                $newValues
            );
            $this->view("Dashboard/admin/manajemenData/manajemenData", "Manajemen Data", $body);
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
