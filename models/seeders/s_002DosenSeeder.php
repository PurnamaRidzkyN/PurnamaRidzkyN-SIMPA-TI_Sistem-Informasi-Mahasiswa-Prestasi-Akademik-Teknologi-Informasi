<?php

use app\models\BaseSeeder;
use app\models\database\users\Dosen;

class s_002DosenSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["D001", "D002", "D003"];
        $id_user= ["U007", "U008", "U009"];
        
        $nidn = [
            "123456789",
            "987654321",
            "112233445"
        ];
        $nama = [
            "Dr. John Doe",
            "Dr. Jane Smith",
            "Dr. Alan Turing"
        ];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = Dosen::insert([
                "id" => $id[$i],
                "id_user"=> $id_user[$i],
                "nidn" => $nidn[$i],
                "nama" => $nama[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return Dosen::deleteAll();
    }
}
