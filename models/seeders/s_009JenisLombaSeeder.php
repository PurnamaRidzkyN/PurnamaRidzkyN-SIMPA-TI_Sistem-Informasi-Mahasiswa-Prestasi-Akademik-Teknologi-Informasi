<?php

use app\models\BaseSeeder;
use app\models\database\prestasiLomba\JenisLomba;

class s_009JenisLombaSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["JL001", "JL002", "JL003"];
        $jenis_lomba = [
            "Lomba Karya Tulis Ilmiah",
            "Hackathon Mahasiswa",
            "Kompetisi Desain Poster"
        ];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = JenisLomba::insert([
                JenisLomba::ID => $id[$i],
                JenisLomba::JENIS_LOMBA => $jenis_lomba[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return JenisLomba::deleteAll();
    }
}
