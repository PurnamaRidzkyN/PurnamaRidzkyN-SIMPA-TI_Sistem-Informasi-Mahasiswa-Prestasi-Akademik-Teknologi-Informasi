<?php

use app\models\BaseSeeder;
use app\models\database\prestasiLomba\JenisLomba;

class s_009JenisLombaSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["JL001", "JL002", "JL003"];
        $jenis_lomba = [
            "Sains",
            "Seni",
            "Olahraga",
            "Lain-lain"
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
