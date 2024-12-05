<?php

use app\models\BaseSeeder;
use app\models\database\prestasiLomba\InfoLomba;

class s_006InfoLombaSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["L001", "L002", "L003"];
        $judul = [
            "Lomba Karya Tulis Ilmiah Nasional",
            "Hackathon Mahasiswa Indonesia",
            "Kompetisi Desain Poster Kreatif"
        ];
        $deskripsi_lomba = [
            "Lomba karya tulis ilmiah yang mengangkat tema Inovasi Teknologi untuk Masa Depan.",
            "Kompetisi hackathon nasional untuk mengembangkan solusi digital.",
            "Kompetisi desain poster dengan tema Kreativitas untuk Generasi Muda."
        ];
        $tanggal_akhir_pendaftaran = ["2024-01-31", "2024-02-15", "2024-03-10"];
        $link_perlombaan = [
            "https://example.com/lkti",
            "https://example.com/hackathon",
            "https://example.com/desainposter"
        ];
        $file_poster = [
            "poster_lkti.jpg",
            "poster_hackathon.jpg",
            "poster_desainposter.jpg"
        ];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = InfoLomba::insert([
                InfoLomba::ID => $id[$i],
                InfoLomba::JUDUL => $judul[$i],
                InfoLomba::DESKRIPSI_LOMBA => $deskripsi_lomba[$i],
                InfoLomba::TANGGAL_AKHIR_PENDAFTARAN => $tanggal_akhir_pendaftaran[$i],
                InfoLomba::LINK_PERLOMBAAN => $link_perlombaan[$i],
                InfoLomba::FILE_POSTER => $file_poster[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return InfoLomba::deleteAll();
    }
}
