<?php

use app\models\BaseSeeder;
use app\models\database\users\Admin;

class s_004AdminSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id = ["A001", "A002", "A003"];
        $id_user = ["U001", "U002", "U003"];
        $nip = ["100321104","100321105","100321106",];
        $name = ["Admin One", "Admin Two", "Admin Three"];
        $foto = ['public\uploads\fotoProfiles\aerithFoto.jpg', 'public\uploads\fotoProfiles\aerithFoto.jpg', 'public\uploads\fotoProfiles\aerithFoto.jpg'];
        $email = ["naotomori220405@gmail.com", "admin2@example.com", "admin3@example.com"];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = Admin::insert([
                Admin::ID => $id[$i],
                Admin::ID_USER => $id_user[$i],
                Admin::NIP => $nip[$i],
                Admin::NAMA => $name[$i],
                Admin::FOTO => $foto[$i],
                Admin::EMAIL => $email[$i],
            ]);
        }

        return $res;
    }

    public function delete(): array
    {
        return Admin::deleteAll();
    }
}
