<?php

use app\models\BaseSeeder;
use app\models\database\prestasiLomba\Peringkat;

class s_008PeringkatSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["P001", "P002", "P003"];
        $peringkat = [1, 2, 3];
        $skor = [100, 75, 50];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = Peringkat::insert([
                Peringkat::ID => $id[$i],
                Peringkat::PERINGKAT => $peringkat[$i],
                Peringkat::SKOR => $skor[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return Peringkat::deleteAll();
    }
}
