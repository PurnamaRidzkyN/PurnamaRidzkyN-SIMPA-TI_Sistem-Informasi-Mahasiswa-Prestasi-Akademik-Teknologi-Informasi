<?php

use app\models\BaseSeeder;
use app\models\database\prestasiLomba\Prestasi;

class s_007PrestasiSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["DP001", "DP002", "DP003"];
        $id_jenis_kompetisi = ["JK001", "JK002", "JK003"];
        $id_tingkat_kompetisi = ["TK001", "TK002", "TK003"];
        $id_mahasiswa = ["M001", "M002", "M003"];
        $id_peringkat = ["P001", "P002", "P003"];

        $tim = [0, 0, 0];
        $judul_kompetisi = [
            "Lomba Karya Tulis Ilmiah Nasional",
            "Hackathon Mahasiswa Indonesia",
            "Kompetisi Desain Poster Kreatif"
        ];
        $judul_kompetisi_en = [
            "National Scientific Paper Competition",
            "Indonesia Student Hackathon",
            "Creative Poster Design Competition"
        ];
        $tempat_kompetisi = [
            "Jakarta, Indonesia",
            "Bandung, Indonesia",
            "Surabaya, Indonesia"
        ];
        $tempat_kompetisi_en = [
            "Jakarta, Indonesia",
            "Bandung, Indonesia",
            "Surabaya, Indonesia"
        ];
        $url_kompetisi = [
            "https://example.com/lkti",
            "https://example.com/hackathon",
            "https://example.com/desainposter"
        ];
        $tanggal_mulai = ["2024-01-15", "2024-02-01", "2024-03-10"];
        $tanggal_akhir = ["2024-01-20", "2024-02-05", "2024-03-15"];
        $jumlah_pt = [50, 40, 30];
        $jumlah_peserta = [100, 80, 60];
        $no_surat_tugas = ["ST001", "ST002", "ST003"];
        $tanggal_surat_tugas = ["2024-01-10", "2024-01-20", "2024-02-01"];
        $file_surat_tugas = ["surat_lkti.pdf", "surat_hackathon.pdf", "surat_desainposter.pdf"];
        $file_sertifikat = ["sertifikat_lkti.pdf", "sertifikat_hackathon.pdf", "sertifikat_desainposter.pdf"];
        $foto_kegiatan = ["foto_lkti.jpg", "foto_hackathon.jpg", "foto_desainposter.jpg"];
        $file_poster = ["poster_lkti.jpg", "poster_hackathon.jpg", "poster_desainposter.jpg"];
        $validasi = [1, 1, 1];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = Prestasi::insert([
                Prestasi::ID => $id[$i],
                Prestasi::ID_JENIS_KOMPETISI => $id_jenis_kompetisi[$i],
                Prestasi::ID_TINGKAT_KOMPETISI => $id_tingkat_kompetisi[$i],
                Prestasi::ID_MAHASISWA => $id_mahasiswa[$i],
                Prestasi::ID_PERINGKAT => $id_peringkat[$i],
                Prestasi::TIM => $tim[$i],
                Prestasi::JUDUL_KOMPETISI => $judul_kompetisi[$i],
                Prestasi::JUDUL_KOMPETISI_EN => $judul_kompetisi_en[$i],
                Prestasi::TEMPAT_KOMPETISI => $tempat_kompetisi[$i],
                Prestasi::TEMPAT_KOMPETISI_EN => $tempat_kompetisi_en[$i],
                Prestasi::URL_KOMPETISI => $url_kompetisi[$i],
                Prestasi::TANGGAL_MULAI => $tanggal_mulai[$i],
                Prestasi::TANGGAL_AKHIR => $tanggal_akhir[$i],
                Prestasi::JUMLAH_PT => $jumlah_pt[$i],
                Prestasi::JUMLAH_PESERTA => $jumlah_peserta[$i],
                Prestasi::NO_SURAT_TUGAS => $no_surat_tugas[$i],
                Prestasi::TANGGAL_SURAT_TUGAS => $tanggal_surat_tugas[$i],
                Prestasi::FILE_SURAT_TUGAS => $file_surat_tugas[$i],
                Prestasi::FILE_SERTIFIKAT => $file_sertifikat[$i],
                Prestasi::FOTO_KEGIATAN => $foto_kegiatan[$i],
                Prestasi::FILE_POSTER => $file_poster[$i],
                Prestasi::VALIDASI => $validasi[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return Prestasi::deleteAll();
    }
}
