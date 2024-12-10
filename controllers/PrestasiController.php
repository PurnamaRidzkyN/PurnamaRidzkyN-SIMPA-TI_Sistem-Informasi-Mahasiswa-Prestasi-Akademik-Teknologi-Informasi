<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\helpers\Dump;
use app\helpers\UUID;
use app\models\database\logData\LogData;
use app\models\database\prestasiLomba\DosenPembimbing;
use app\models\database\prestasiLomba\JenisLomba;
use app\models\database\prestasiLomba\Peringkat;
use app\models\database\prestasiLomba\Prestasi;
use app\models\database\prestasiLomba\TingkatLomba;
use app\models\database\users\Dosen;
use app\models\database\users\Mahasiswa;
use app\helpers\ArrayFormatter;
use app\helpers\FileUpload;
use app\models\database\users\Admin;

class PrestasiController extends BaseController
{

    public function upload(Request $req, Response $res): void
    {
        $body = $req->body();
        $mahasiswa = Mahasiswa::findNim(Session::get("user"));

        $id = UUID::generate("prestasi", "P");
        $id_jenis_kompetisi = $body["jenis-kompetisi"] ?? "null";
        $id_tingkat_kompetisi = $body["tingkat-kompetisi"] ?? "null";
        $id_mahasiswa = $mahasiswa['result'][0]["id"] ?? "null";
        $id_peringkat = $body["peringkat"] ?? "null";
        $id_admin = "null";
        $tim = ($body["kategori-kompetisi"] == "tim") ? 1 : 0;
        $judul_kompetisi = $body["judul-kompetisi"] ?? "null";
        $judul_kompetisi_en = $body["judul-kompetisi-en"] ?? "null";
        $tempat_kompetisi = $body["tempat-kompetisi"] ?? "null";
        $tempat_kompetisi_en = $body["tempat-kompetisi-en"] ?? "null";
        $url_kompetisi = $body["url-kompetisi"] ?? "null";
        $tanggal_mulai = $body["tanggal-mulai"] ?? "null";
        $tanggal_akhir = $body["tanggal-akhir"] ?? "null";
        $jumlah_pt = $body["jumlah-pt"] ?? "null";
        $jumlah_peserta = $body["jumlah-peserta"] ?? "null";
        $no_surat_tugas = $body["no-surat-tugas"] ?? "null";
        $tanggal_surat_tugas = $body["tanggal-surat-tugas"] ?? "null";
        $file_surat_tugas = $body["file-surat-tugas"] ?? "null";
        $file_sertifikat = $body["file-sertifikat"] ?? "null";
        $foto_kegiatan = $body["foto-kegiatan"] ?? "null";
        $file_poster = $body["file-poster"] ?? "null";
        $validasi = 0;
        try {

            $file_surat_tugas = FileUpload::uploadFile($file_surat_tugas, FileUpload::TARGET_DIR_SURAT_TUGAS);
            $file_sertifikat = FileUpload::uploadFile($file_sertifikat, FileUpload::TARGET_DIR_SERTIFIKAT);
            $foto_kegiatan = FileUpload::uploadFile($foto_kegiatan, FileUpload::TARGET_DIR_FOTO);
            $file_poster = FileUpload::uploadFile($file_poster, FileUpload::TARGET_DIR_POSTER);



            $data = [
                "id" => $id,
                "id_jenis_kompetisi" => $id_jenis_kompetisi,
                "id_tingkat_kompetisi" => $id_tingkat_kompetisi,
                "id_mahasiswa" => $id_mahasiswa,
                "id_peringkat" => $id_peringkat,
                "id_admin" => $id_admin,
                "tim" => $tim,
                "judul_kompetisi" => $judul_kompetisi,
                "judul_kompetisi_en" => $judul_kompetisi_en,
                "tempat_kompetisi" => $tempat_kompetisi,
                "tempat_kompetisi_en" => $tempat_kompetisi_en,
                "url_kompetisi" => $url_kompetisi,
                "tanggal_mulai" => $tanggal_mulai,
                "tanggal_akhir" => $tanggal_akhir,
                "jumlah_pt" => $jumlah_pt,
                "jumlah_peserta" => $jumlah_peserta,
                "no_surat_tugas" => $no_surat_tugas,
                "tanggal_surat_tugas" => $tanggal_surat_tugas,
                "file_surat_tugas" => $file_surat_tugas,
                "file_sertifikat" => $file_sertifikat,
                "foto_kegiatan" => $foto_kegiatan,
                "file_poster" => $file_poster,
                "validasi" => $validasi
            ];
            $dosen = [];

            // Loop melalui data POST untuk mendapatkan setiap dosen
            foreach ($body as $key => $value) {
                // Menyaring hanya yang dimulai dengan 'dosen-pembimbing-'
                if (strpos($key, 'dosen-') === 0) {
                    $value = Dosen::findName($value);
                    $dosen[] = $value["result"][0]["id"];
                }
            }

            $prestasiData = ArrayFormatter::formatKeyValue($data);

            Prestasi::insert($data);
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $mahasiswa['result'][0]["id_user"],
                $data["id"],
                Prestasi::TABLE,
                "insert",
                "null",
                "null",
                $prestasiData
            );

            $user = Session::get("user");;
            for ($i = 0; $i < count($dosen); $i++) {
                $data = [];
                $id = UUID::generate(DosenPembimbing::TABLE, "DP");
                $data = ([
                    DosenPembimbing::ID => $id,
                    DosenPembimbing::ID_Dosen => $dosen[$i],
                    DosenPembimbing::ID_PRESTASI => $id,
                ]);

                DosenPembimbing::insert($data);

                $dosenData = ArrayFormatter::formatKeyValue($data);

                LogData::insert(
                    UUID::generate(LogData::TABLE, "LD"),
                    $mahasiswa['result'][0]["id_user"],
                    $id,
                    DosenPembimbing::TABLE,
                    "insert",
                    "null",
                    "null",
                    $dosenData
                );
            }
            $user = Session::get("user");

            $res->redirect("/dashboard/mahasiswa/{$user}/prestasi");
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function renderWeb(): void
    {
        $JenisLomba = JenisLomba::displayJenisLomba();
        $tingkatLomba = TingkatLomba::displayTingkatLomba();
        $peringkat = Peringkat::displayPeringkat();
        $dosen = Dosen::displayDosen();

        $data = [
            'JenisLomba' => $JenisLomba['result'],
            'TingkatLomba' => $tingkatLomba['result'],
            'Peringkat' => $peringkat['result'],
            'Dosen' => $dosen['result']
        ];
        $this->view("dashboard/mahasiswa/uploadPrestasi", "Upload Prestasi", $data);
    }
    public function renderListPrestasi(Request $req, response $res)
    {
        $body = $req->body();
        $data = Prestasi::listPrestasiDisplay();
        $nim = $body["nim"];
        try {
            if (Session::get("role") == "1") {
                $filtered_data = array_filter($data["result"], function ($item) use ($nim) {
                    return $item["nim"] === $nim;
                });
            } elseif ((Session::get("role") == "2")) {
                $nim= Mahasiswa::findNim(Session::get("user"))["result"][0]["nim"];
                $filtered_data = array_filter($data["result"], function ($item) use ($nim) {
                    return $item["nim"] === $nim;
                });
            } 
            $this->view("dashboard/listPrestasi", "list prestasi", $filtered_data);
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    public function renderDetailPrestasi(Request $req)
    {
        $body = $req->body();
        $id = $body["prestasi_id"];
        $data = Prestasi::findId($id);
        $data = $data["result"][0];
        $dosen = DosenPembimbing::displayDosenPembimbing();
        $dosen = $dosen["result"];
        $data = [
            "dosen" => $dosen,
            "prestasi" => $data
        ];

        $this->view("dashboard/detailPrestasi", "Detail Prestasi", $data);
    }

    public function validatePrestasi(Request $request, Response $response)
    {
        // Ambil data dari request
        $body = $request->Body();
        $user = Session::get("user");

        try {
            // Validasi input

            $admin = Admin::findNip(Session::get("user"));
            $idPrestasi = $body['prestasi_id'];
            $validasiStatus = $body['action_validasi'] === 'validasi' ? "1" : "0";

            if ($validasiStatus == "1") {
                $updateValidasi = Prestasi::updatePrestasi($validasiStatus, Prestasi::ID, $idPrestasi);
                $updateAdmin = Prestasi::updateIdAdmin($admin['result'][0]["id"], Prestasi::ID, $idPrestasi);
                $response->redirect("/dashboard/admin/{$user}/prestasi");
            } else {
                $response->redirect("/dashboard/admin/{$user}/prestasi");
            }
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function renderDaftarMahasiswa(): void
    {
        $data = Mahasiswa::displayMahasiswa();
        $this->view("/dashboard/admin/daftarMahasiswaBerprestasi", "Daftar Mahasiswa", $data);
    }
}
