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
            "234176001",
            "234176002",
            "234176003"
        ];
        $prodi = [
            "Teknik Informatika",
            "Sistem Informasi Bisnis",
            "Sistem Informasi Bisnis"
        ];
        $tahun_masuk = ["2021", "2020", "2022"];
        $total_skor = [150,175,200 ];
        $foto = [
            'public\uploads\fotoProfiles\ppges.jpg',
            'public\uploads\fotoProfiles\ppges.jpg',
            'public\uploads\fotoProfiles\ppges.jpg'
        ];
        $email = [
            "alice.johnson@example.com",
            "bob.williams@example.com",
            "charlie.brown@example.com"
        ];
        $jurusan=[
            "Teknologi Informasi","Teknologi Informasi","Teknologi Informasi"
        ];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = Mahasiswa::insert([
                "id" => $id[$i],
                "id_user" => $id_user[$i],
                "nama" => $nama[$i],
                "nim" => $nim[$i],
                "prodi" => $prodi[$i],
                "jurusan"=> $jurusan[$i],
                "tahun_masuk" => $tahun_masuk[$i],
                "total_skor" => $total_skor[$i],
                "foto" => $foto[$i],
                "email"=> $email[$i]
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return Mahasiswa::deleteAll();
    }
}
