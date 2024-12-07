<?php

use app\models\BaseSeeder;
use app\models\database\users\User;

class s_001UserSeeder implements BaseSeeder
{
    public function create(): array
    {
        $id=["U001", "U002", "U003", "U004", "U005", "U006","U007","U008","U009"];
        $username = [
            "100321104",
            "100321105",
            "100321106",
            "234176001",
            "234176002",
            "234176003",
            "123456789",
            "987654321",
            "112233445"
        ];

        $password = [
            "admin1",
            "admin2",
            "admin3",
            "Mahasiswa1",
            "Mahasiswa2",
            "Mahasiswa3",
            "Dr. John Doe",
            "Dr. Jane Smith",
            "Dr. Alan Turing"
        ];

        $role = [
            1,
            1,
            1,
            2,
            2,
            2,
            3,
            3,
            3,
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