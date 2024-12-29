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
use app\models\database\prestasiLomba\InfoLomba;
use app\models\database\prestasiLomba\JenisLomba;
use app\models\database\prestasiLomba\Peringkat;
use app\models\database\prestasiLomba\TingkatLomba;
use app\helpers\ArrayFormatter;
use app\helpers\FileUpload;

class UserManagement extends BaseController
{

    public function manageData(Request $req, Response $res)
    {
        $body = $req->body();
        $user = Admin::findNip(Session::get("user"));
        if ($body["action"] === "add") {
            if ($body["data"] === "admin") {
                $this->insertAdminUsers($body);
                Dump::out("j");
                

            } else if ($body["data"] === "mahasiswa") {
                $this->insertMahasiswaUsers($body);
            } else if ($body["data"] === "dosen") {
                $this->insertDosenUsers($body);
            }
        } else if ($body["action"] === "update") {
            if ($body["data"] === "admin") {
                $this->updateDataAdmin($body);
            } else if ($body["data"] === "mahasiswa") {
                $this->updateDataMahasiswa($body);
            } else if ($body["data" === "dosen"]) {
                $this->updateDataDosen($body);
            }
        } else if (!is_null($body["delete"])) {
            if ($body["data"] === "admin") {
                $this->deleteDataAdmin($body);
            } else if ($body["data"] === "mahasiswa") {
                $this->deleteDataMahasiswa($body);
            } else if ($body["data" === "dosen"]) {
                $this->deleteDataDosen($body);
            }
        }
        $res->redirect("/dashboard/admin/{$user['result'][0]["nip"]}/manajemen-data");

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

    public function insertInfoLomba(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $judul = $body['judul'];
        $deskripsi = $body['deskripsi_lomba'];
        $tanggalAkhirPendaftaran = $body['tanggal_akhir_pendaftaran'];
        $linkPerlombaan = $body['link_perlombaan'];
        $filePoster = $body['file_poster'];

        try {
            // Upload file poster
            $filePosterPath = FileUpload::uploadFile($filePoster, FileUpload::TARGET_DIR_POSTER);

            // Data untuk tabel info_lomba
            $infoLombaData = [
                "id" => UUID::generate(InfoLomba::TABLE, "IL"),
                InfoLomba::JUDUL => $judul,
                InfoLomba::DESKRIPSI_LOMBA => $deskripsi,
                InfoLomba::TANGGAL_AKHIR_PENDAFTARAN => $tanggalAkhirPendaftaran,
                InfoLomba::LINK_PERLOMBAAN => $linkPerlombaan,
                InfoLomba::FILE_POSTER => $filePosterPath,
            ];
            InfoLomba::insert($infoLombaData);

            // Format data untuk logging
            $data = ArrayFormatter::formatKeyValue($infoLombaData);

            // Insert log untuk operasi insert
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $infoLombaData["id"],
                InfoLomba::TABLE,
                "insert",
                "null",
                "null",
                $data
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function insertJenisLomba(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $jenisLomba = $body['jenis_lomba'];

        try {
            // Data untuk tabel jenis_lomba
            $jenisLombaData = [
                "id" => UUID::generate(JenisLomba::TABLE, "JL"),
                JenisLomba::JENIS_LOMBA => $jenisLomba,
            ];
            JenisLomba::insert($jenisLombaData);

            // Format data untuk logging
            $data = ArrayFormatter::formatKeyValue($jenisLombaData);

            // Insert log untuk operasi insert
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $jenisLombaData["id"],
                JenisLomba::TABLE,
                "insert",
                "null",
                "null",
                $data
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function insertPeringkat(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $peringkat = $body['peringkat'];
        $skor = $body['skor'];

        try {
            // Data untuk tabel peringkat
            $peringkatData = [
                "id" => UUID::generate(Peringkat::TABLE, "P"),
                Peringkat::PERINGKAT => $peringkat,
                Peringkat::SKOR => $skor
            ];

            // Menyisipkan data ke tabel peringkat
            Peringkat::insert($peringkatData);

            // Format data untuk logging
            $data = ArrayFormatter::formatKeyValue($peringkatData);

            // Insert log untuk operasi insert
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $peringkatData["id"],
                Peringkat::TABLE,
                "insert",
                "null",
                "null",
                $data
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function insertTingkatLomba(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $tingkatLomba = $body['tingkat_lomba'];
        $skor = $body['skor'];

        try {

            // Insert the new level (tingkat_lomba) data into the database
            $dataTingkatLomba = [
                TingkatLomba::ID => UUID::generate(TingkatLomba::TABLE, "TL"),
                TingkatLomba::TINGKAT_LOMBA => $tingkatLomba,
                TingkatLomba::SKOR => $skor
            ];

            // Insert the data into the TingkatLomba table
            TingkatLomba::insert($dataTingkatLomba);

            // Prepare data for logging
            $data = ArrayFormatter::formatKeyValue($dataTingkatLomba);

            // Insert log data to track the insertion
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $dataTingkatLomba[TingkatLomba::ID],
                TingkatLomba::TABLE,
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
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function updateDataMahasiswa(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['id'];
        $id_user = $body['id_user'];
        $name = $body['nama'];
        $nim = $body['nim'];
        $prodi = $body['prodi'];
        $jurusan = $body['jurusan'];
        $tahun_masuk = $body['tahun_masuk'];
        $foto = $body['foto'];
        $email = $body['email'];

        try {
            // Validasi data lama
            $oldData = Mahasiswa::findNim($nim)['result'][0];
            // Proses foto
            if (isset($foto['type']) && !is_null($foto['type'])) {
                $fileFoto = FileUpload::uploadFile($foto, FileUpload::TARGET_DIR_FOTO_PROFILE);
            } else {
                $fileFoto = $oldData['foto'];
            }

            // Data baru
            $newData = [
                Mahasiswa::ID => $id,
                Mahasiswa::NAMA => $name,
                Mahasiswa::NIM => $nim,
                Mahasiswa::PRODI => $prodi,
                Mahasiswa::JURUSAN => $jurusan,
                Mahasiswa::TAHUN_MASUK => $tahun_masuk,
                Mahasiswa::FOTO => $fileFoto,
                Mahasiswa::EMAIL => $email,
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


            Mahasiswa::updateData($newData);

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
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    public function updateDataDosen(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['id'];
        $name = $body['nama'];
        $email = $body['email'];
        $foto = $body['foto'];
        $nidn = $body['nidn'];

        try {
            // Validasi data lama
            $oldData = Dosen::findNidn($nidn)['result'][0];
            // Proses foto
            if (isset($foto['type']) && !is_null($foto['type'])) {
                $fileFoto = FileUpload::uploadFile($foto, FileUpload::TARGET_DIR_FOTO_PROFILE);
            } else {
                $fileFoto = $oldData['foto'];
            }

            // Data baru
            $newData = [
                Dosen::ID => $id,
                Dosen::NIDN => $nidn,
                Dosen::NAMA => $name,
                Dosen::EMAIL => $email,
                Dosen::FOTO => $fileFoto,
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

            Dosen::updateData($newData);

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
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }

    }

    public function updateInfoLomba(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['id'];
        $judul = $body['judul'];
        $deskripsi = $body['deskripsi_lomba'];
        $tanggalAkhirPendaftaran = $body['tanggal_akhir_pendaftaran'];
        $linkPerlombaan = $body['link_perlombaan'];
        $filePoster = $body['file_poster'];

        try {
            // Validasi data lama
            $oldData = InfoLomba::findInfoLomba('id', $id)['result'][0];

            // Proses file poster
            if (isset($filePoster['type']) && !is_null($filePoster['type'])) {
                $filePosterPath = FileUpload::uploadFile($filePoster, FileUpload::TARGET_DIR_POSTER);
            } else {
                $filePosterPath = $oldData[InfoLomba::FILE_POSTER];
            }

            // Data baru
            $newData = [
                InfoLomba::ID => $id,
                InfoLomba::JUDUL => $judul,
                InfoLomba::DESKRIPSI_LOMBA => $deskripsi,
                InfoLomba::TANGGAL_AKHIR_PENDAFTARAN => $tanggalAkhirPendaftaran,
                InfoLomba::LINK_PERLOMBAAN => $linkPerlombaan,
                InfoLomba::FILE_POSTER => $filePosterPath,
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

            foreach ($differences as $difference) {
                $columns[] = $difference['column'];
                $oldValues[] = $difference['old_value'];
                $newValues[] = $difference['new_value'];
            }

            $columns = implode(', ', $columns);
            $oldValues = implode(', ', $oldValues);
            $newValues = implode(', ', $newValues);

            InfoLomba::updateInfoLomba(
                $column = 'judul',          // Kolom yang akan di-update
                $value = $newData['judul'], // Nilai baru untuk kolom tersebut
                $columnWhere = 'id',        // Kolom untuk kondisi WHERE
                $where = $newData['id']     // Nilai kondisi WHERE
            );

            // Masukkan log
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                InfoLomba::TABLE,
                "update",
                $columns, // Catat kolom yang berubah
                $oldValues,
                $newValues
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function updateJenisLomba(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['id'];
        $jenisLomba = $body['jenis_lomba'];

        try {
            // Validasi data lama
            $oldData = JenisLomba::find(JenisLomba::ID, $id)['result'][0];

            // Data baru
            $newData = [
                JenisLomba::ID => $id,
                JenisLomba::JENIS_LOMBA => $jenisLomba,
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

            // Iterasi untuk mendapatkan data perbedaan
            foreach ($differences as $difference) {
                $columns[] = $difference['column'];
                $oldValues[] = $difference['old_value'];
                $newValues[] = $difference['new_value'];
            }

            $columns = implode(', ', $columns);
            $oldValues = implode(', ', $oldValues);
            $newValues = implode(', ', $newValues);

            // Update data
            JenisLomba::updateJenisLomba(JenisLomba::JENIS_LOMBA, $jenisLomba, JenisLomba::ID, $id);

            // Masukkan log
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                JenisLomba::TABLE,
                "update",
                $columns, // Catat kolom yang berubah
                $oldValues,
                $newValues
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function updatePeringkat(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['id'];
        $peringkat = $body['peringkat'];
        $skor = $body['skor'];

        try {
            // Validasi data lama
            $oldData = Peringkat::findPeringkat(Peringkat::ID, $id)['result'][0]; 

            // Data baru
            $newData = [
                Peringkat::ID => $id,
                Peringkat::PERINGKAT => $peringkat,
                Peringkat::SKOR => $skor,
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

            // Update data peringkat
            Peringkat::updatePeringkat($newData[Peringkat::SKOR], Peringkat::ID, $id);

            // Masukkan log
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                Peringkat::TABLE,
                "update",
                $columns, // Catat kolom yang berubah
                $oldValues,
                $newValues
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function updateTingkatLomba(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['id'];
        $tingkatLomba = $body['tingkat_lomba'];
        $skor = $body['skor'];

        try {
            // Validasi data lama
            $oldData = TingkatLomba::find(TingkatLomba::ID, $id)['result'][0];

            // Data baru
            $newData = [
                TingkatLomba::ID => $id,
                TingkatLomba::TINGKAT_LOMBA => $tingkatLomba,
                TingkatLomba::SKOR => $skor,
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

            // Update the TingkatLomba table
            TingkatLomba::updateTingkatLomba($skor, TingkatLomba::ID, $id);

            // Masukkan log
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                TingkatLomba::TABLE,
                "update",
                $columns, // Catat kolom yang berubah
                $oldValues,
                $newValues
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }



    public function deleteDataAdmin(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['delete'];
        try {
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                Admin::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $id,
                ""
            );
            Admin::deleteData($id);
            User::deleteData($body['id_user']);
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $body['id_user'],
                User::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $body['id_user'],
                ""
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    public function deleteDataMahasiswa(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['delete'];
        try {
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                Mahasiswa::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $id,
                ""
            );
            Mahasiswa::deleteData($id);
            User::deleteData($body['id_user']);
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $body['id_user'],
                User::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $body['id_user'],
                ""
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    public function deleteDataDosen(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['delete'];
        try {
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                Dosen::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $id,
                ""
            );
            Dosen::deleteData($id);
            User::deleteData($body['id_user']);
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $body['id_user'],
                User::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $body['id_user'],
                ""
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function deleteInfoLomba(array $body)
    {
        // Mendapatkan data admin berdasarkan sesi pengguna
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['delete'];
        try {
            // Menambahkan log data untuk penghapusan info lomba
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"], // ID pengguna admin
                $id,                            // ID data yang akan dihapus
                InfoLomba::TABLE,               // Nama tabel yang dimodifikasi
                "delete",                       // Jenis operasi (penghapusan)
                "semuanya",                     // Detail penghapusan (semua kolom)
                "seluruhnya pada id =" . $id,   // Keterangan penghapusan
                ""
            );

            // Menghapus data dari tabel info_lomba berdasarkan ID
            InfoLomba::deleteData($id);

            // Tambahkan log tambahan jika ada data terkait lainnya yang dihapus (opsional)
        } catch (\PDOException $e) {
            // Menampilkan pesan error jika terjadi kesalahan database
            var_dump($e->getMessage());
        }
    }

    public function deleteJenisLomba(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['delete'];
        try {
            // Masukkan log untuk penghapusan data jenis lomba
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                JenisLomba::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id = " . $id,
                ""
            );

            // Hapus data jenis lomba berdasarkan ID
            JenisLomba::deleteData($id);

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function deletePeringkat(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['delete'];
        try {
            // Catat log untuk penghapusan data peringkat
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                Peringkat::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $id,
                ""
            );

            // Hapus data peringkat
            Peringkat::deleteData($id);

            // Masukkan log setelah penghapusan
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                Peringkat::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $id,
                ""
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function deleteTingkatLomba(array $body)
    {
        $Admin = Admin::findNip(Session::get("user"));
        $id = $body['delete'];
        
        try {
            // Insert a log entry before deletion
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                TingkatLomba::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $id,
                ""
            );

            // Delete the TingkatLomba data by id
            TingkatLomba::deleteData($id);

            // Log the deletion after it has been completed
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $Admin['result'][0]["id_user"],
                $id,
                TingkatLomba::TABLE,
                "delete",
                "semuanya",
                "seluruhnya pada id =" . $id,
                ""
            );
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }



}
