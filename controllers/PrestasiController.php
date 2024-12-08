<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\helpers\Dump;
use app\helpers\UUID;
use app\models\database\logData\LogData;
use app\models\database\prestasiLomba\JenisLomba;
use app\models\database\prestasiLomba\Peringkat;
use app\models\database\prestasiLomba\Prestasi;
use app\models\database\prestasiLomba\TingkatLomba;
use app\models\database\users\Dosen;
use app\models\database\users\Mahasiswa;

class PrestasiController extends BaseController
{

    public function upload(Request $req, Response $res): void
    {
        $body = $req->body();
        $mahasiswa = Mahasiswa::findNim(Session::get("user"));
        Dump::out($body);
        exit();
        $target_dir = "public/uploads/";
        $target_dir_surat_tugas = $target_dir . "suratTugas/";  //
        $target_dir_sertifikat = $target_dir . "sertifikat/";
        $target_dir_foto = $target_dir . "fotokegiatan/";
        $target_dir_poster = $target_dir . "poster/";

        
        $id = UUID::generate("prestasi", "P");
        $id_jenis_kompetisi = $body["jenis-kompetisi"] ?? "null";
        $id_tingkat_kompetisi = $body["tingkat-kompetisi"] ?? "null";
        $id_mahasiswa = $mahasiswa['result'][0]["id"] ?? "null";
        $id_peringkat = $body["perinkat"] ?? "null";
        $id_admin = "null"; // Tetap nilai default
        $tim = ($body["kategori-kompetisi"] == "Tim") ? 1 : 0;
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
        $validasi = 0; // 5 MB dalam byte
        // Validasi dan pemrosesan file surat tugas
        try {
            // Fungsi untuk memeriksa dan memindahkan file jika valid
            // Fungsi untuk menangani pengunggahan file
            function uploadFile($file, $target_dir)
            {
                $max_size = 5 * 1024 * 1024;
                if ($file && isset($file["tmp_name"]) && $file["error"] == 0) {
                    $file_size = $file["size"];
                    if ($file_size > $max_size) {
                    } else {
                        $target_file = $target_dir . basename($file["name"]);
                    }
                } else {
                    echo "File tidak diunggah atau terjadi kesalahan.<br>";
                }

                return $target_file;
            }

            // Pengunggahan file surat tugas
            // Pengunggahan file surat tugas
            $file_surat_tugas =  uploadFile($file_surat_tugas, $target_dir_surat_tugas);

            // Pengunggahan file sertifikat
            $file_sertifikat = uploadFile($file_sertifikat, $target_dir_sertifikat);

            // Pengunggahan foto kegiatan
            $foto_kegiatan = uploadFile($foto_kegiatan, $target_dir_foto);

            // Pengunggahan file poster
            $file_poster = uploadFile($file_poster, $target_dir_poster);


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

            Prestasi::insert($data);
            $result = implode(", ", array_map(function ($key, $value) {
                return "$key = $value";
            }, array_keys($data), $data));
            LogData::insert(
                UUID::generate(LogData::TABLE, "LD"),
                $mahasiswa['result'][0]["id_user"],
                $mahasiswa['result'][0]["id"],
                Mahasiswa::TABLE,
                "insert",
                "null",
                "null",
                $result
            );
            $user = Session::get("user");
            $res->redirect("/dashboard/mahasiswa/{$user}/prestasi");
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function renderWeb(): void
    {
        $JenisLomba=JenisLomba::displayJenisLomba();
        $tingkatLomba = TingkatLomba::displayTingkatLomba();
        $peringkat = Peringkat::displayPeringkat();
        $dosen = Dosen::displayDosen();

        $data = [
            'JenisLomba' => $JenisLomba['result'],
            'TingkatLomba' => $tingkatLomba['result'],
            'Peringkat' => $peringkat['result'],
            'Dosen' => $dosen['result']
        ]; 
        $this->view("dashboard/mahasiswa/uploadPrestasi", "Upload Prestasi",$data);
    }
    public function renderListPrestasi()
    {
        $data = Prestasi::prestasiDisplay();
        $nim = Session::get("user");
        try {

            if (Session::get("role") !== "1") {
                $filtered_data = array_filter($data["result"], function ($item) use ($nim) {
                    return $item["nim"] === $nim;
                });
            } else {
                $filtered_data = $data["result"];
            }
            $this->view("dashboard/listPrestasi", "list prestasi", $filtered_data);
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
