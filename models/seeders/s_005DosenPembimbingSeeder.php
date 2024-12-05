<?php

use app\models\BaseSeeder;
use app\models\database\prestasiLomba\DosenPembimbing;

class s_005DosenPembimbingSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["DP001", "DP002", "DP003"];
        $id_dosen = ["D001", "D002", "D003"];
        $id_prestasi = ["P001", "P002", "P003"];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = DosenPembimbing::insert([
                DosenPembimbing::ID => $id[$i],
                DosenPembimbing::ID_Dosen => $id_dosen[$i],
                DosenPembimbing::ID_PRESTASI => $id_prestasi[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return DosenPembimbing::deleteAll();
    }
}
