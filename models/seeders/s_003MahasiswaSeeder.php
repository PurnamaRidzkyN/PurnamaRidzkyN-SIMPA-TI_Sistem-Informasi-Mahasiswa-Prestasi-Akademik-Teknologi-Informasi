<?php

use app\models\BaseSeeder;
use app\models\database\users\Mahasiswa;

class s_003MahasiswaSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["M001", "M002", "M003"];

        $id_user = ["U004", "U005", "U006"];
        
        $nama = [
            "Alice Johnson",
            "Bob Williams",
            "Charlie Brown"
        ];
        $nim = [
            "210101001",
            "210101002",
            "210101003"
        ];
        $prodi = [
            "Teknik Informatika",
            "Sistem Informasi",
            "Ilmu Komputer"
        ];
        $tahun_masuk = ["2021", "2020", "2022"];
        $total_skor = [85, 90, 88];
        $foto = [
            "alice.jpg",
            "bob.jpg",
            "charlie.jpg"
        ];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = Mahasiswa::insert([
                "id" => $id[$i],
                "id_user" => $id_user[$i],
                "nama" => $nama[$i],
                "nim" => $nim[$i],
                "prodi" => $prodi[$i],
                "tahun_masuk" => $tahun_masuk[$i],
                "total_skor" => $total_skor[$i],
                "foto" => $foto[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return Mahasiswa::deleteAll();
    }
}
