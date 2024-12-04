<?php


use app\models\BaseSeeder;
use app\models\database\users\Admin;

class s_001AdminSeeder implements BaseSeeder
{
    public function create(): array
    {
        $nip = ["100321101", "100321102", "100321103", "100321104"];
        $name = ["Dwayne Johnson", "Erick Smith", "Alan Walker", "Elizabeth Rosenberg"];

        $res = [];

        for ($i = 0; $i < count($nip); $i++) {
            $res[$i] = Admin::insert([
                "nip" => $nip[$i],
                "name" => $name[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return Admin::deleteAll();
    }
}