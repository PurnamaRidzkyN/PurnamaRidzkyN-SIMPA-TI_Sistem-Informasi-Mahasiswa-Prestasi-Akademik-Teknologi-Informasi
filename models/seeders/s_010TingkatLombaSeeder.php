<?php

use app\models\BaseSeeder;
use app\models\database\prestasiLomba\TingkatLomba;

class s_010TingkatLombaSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["TL001", "TL002", "TL003"];
        $tingkat_lomba = [
            "Lokal",
            "Regional",
            "Nasional"
        ];
        $skor = [30, 50, 100];

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
