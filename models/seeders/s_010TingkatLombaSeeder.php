<?php

use app\models\BaseSeeder;
use app\models\database\prestasiLomba\TingkatLomba;

class s_010TingkatLombaSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["TL001", "TL002", "TL003","TL004","TL005","TL006"];
        $tingkat_lomba = [
            "Sekolah",
            "Kecamatan",
            "Kab/Kota",
            "Provinsi",
            "Nasional",
            "Internasional"
        ];
        $skor = [5, 10, 20, 30, 40, 50];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = TingkatLomba::insert([
                TingkatLomba::ID => $id[$i],
                TingkatLomba::TINGKAT_LOMBA => $tingkat_lomba[$i],
                TingkatLomba::SKOR => $skor[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return TingkatLomba::deleteAll();
    }
}
