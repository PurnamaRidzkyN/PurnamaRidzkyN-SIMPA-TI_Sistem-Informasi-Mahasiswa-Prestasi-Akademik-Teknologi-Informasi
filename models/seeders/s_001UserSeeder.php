<?php

use app\models\BaseSeeder;
use app\models\database\users\User;

class s_001UserSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id=["U001"];
        $username = [
            "100321104"
        ];

        $password = [
            "admin4"
        ];

        $role = [
            1
        ];

        $res = [];

        for ($i = 0; $i < count($id); $i++) {
            $res[$i] = User::insert([
                "id"=> $id[$i],
                "username" => $username[$i],
                "password" => password_hash($password[$i], PASSWORD_BCRYPT),
                "role" => $role[$i],]);
        }

        return $res;
    }

    public function delete(): array
    {
        return User::deleteAll();
    }
}