<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\helpers\Dump;
use app\helpers\UUID;
use app\models\database\logData\LogData;
use app\models\database\prestasiLomba\Prestasi;
use app\models\database\users\Mahasiswa;

class UploadPrestasi extends BaseController
{
    public function upload(Request $req, Response $res): void
    {
        $body = $req->body();
        $mahasiswa = Mahasiswa::findNim(Session::get("user"));

        $id = UUID::generate("prestasi", "DP");
        $id_jenis_kompetisi = isset($body["id_jenis_kompetisi"]) ? $body["id_jenis_kompetisi"] : "null";
        $id_tingkat_kompetisi = isset($body["id_tingkat_kompetisi"]) ? $body["id_tingkat_kompetisi"] : "null";
        $id_mahasiswa = isset($mahasiswa['result'][0]["id"]) ? $mahasiswa['result'][0]["id"] : "null";
        $id_peringkat = isset($body["id_peringkat"]) ? $body["id_peringkat"] : "null";
        $id_admin = "null"; // Nilai ini sudah di set ke "null" secara default
        $tim = isset($body["tim"]) ? $body["tim"] : "null";
        $judul_kompetisi = isset($body["judul_kompetisi"]) ? $body["judul_kompetisi"] : "null";
        $judul_kompetisi_en = isset($body["judul_kompetisi_en"]) ? $body["judul_kompetisi_en"] : "null";
        $tempat_kompetisi = isset($body["tempat_kompetisi"]) ? $body["tempat_kompetisi"] : "null";
        $tempat_kompetisi_en = isset($body["tempat_kompetisi_en"]) ? $body["tempat_kompetisi_en"] : "null";
        $url_kompetisi = isset($body["url_kompetisi"]) ? $body["url_kompetisi"] : "null";
        $tanggal_mulai = isset($body["tanggal_mulai"]) ? $body["tanggal_mulai"] : "null";
        $tanggal_akhir = isset($body["tanggal_akhir"]) ? $body["tanggal_akhir"] : "null";
        $jumlah_pt = isset($body["jumlah_pt"]) ? $body["jumlah_pt"] : "null";
        $jumlah_peserta = isset($body["jumlah_peserta"]) ? $body["jumlah_peserta"] : "null";
        $no_surat_tugas = isset($body["no_surat_tugas"]) ? $body["no_surat_tugas"] : "null";
        $tanggal_surat_tugas = isset($body["tanggal_surat_tugas"]) ? $body["tanggal_surat_tugas"] : "null";
        $file_surat_tugas = isset($body["file_surat_tugas"]) ? $body["file_surat_tugas"] : "null";
        $file_sertifikat = isset($body["file_sertifikat"]) ? $body["file_sertifikat"] : "null";
        $foto_kegiatan = isset($body["foto_kegiatan"]) ? $body["foto_kegiatan"] : "null";
        $file_poster = isset($body["file_poster"]) ? $body["file_poster"] : "null";
        $validasi = 0; // Nilai sudah diberikan angka 0, tetap tidak perlu perubahan

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

        try {
            Prestasi::insert($data);
            $result = implode(", ", array_map(function($key, $value) {
                return "$key = $value";
            }, array_keys($data), $data));
            LogData::insert(UUID::generate(Mahasiswa::TABLE, "LD"), 
            $mahasiswa['result'][0]["id_user"], 
            $mahasiswa['result'][0]["id"], 
            Mahasiswa::TABLE, 
            "insert", 
            "null", 
            "null", 
            $result);
                } catch (\PDOException $e) {
        }
    }

    public function renderWeb(): void
    {
        $this->view("dashboard/mahasiswa/uploadPrestasi", "Upload Prestasi");
    }
}
