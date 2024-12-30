<?php

namespace app\models\database\users;

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;


class Mahasiswa extends BaseModel
{
    public const TABLE = "Mahasiswa";
    public const ID = "id";
    public const ID_USER = "id_user";
    public const NAMA = "nama";
    public const NIM = "nim";
    public const PRODI = "prodi";
    public const JURUSAN = "jurusan";
    public const TAHUN_MASUK = "tahun_masuk";
    public const TOTAL_SKOR = "total_skor";
    public const FOTO = "foto";
    public const EMAIL = "email";
    public const VIEW = "GetLeaderboard";



    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([
                self::ID,
                self::ID_USER,
                self::NAMA,
                self::NIM,
                self::PRODI,
                self::JURUSAN,
                self::TAHUN_MASUK,
                self::TOTAL_SKOR,
                self::FOTO,
                self::EMAIL
            ], $data);
        });
    }
    public static function findEmail($email): array
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($email) {
            $table->selectWhere(["email" => $email], [self::ID_USER, self::NAMA, self::EMAIL]);
        });
    }
    public static function findId($id): array
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($id) {
            $table->selectWhere(["id" => $id], [self::ID_USER, self::NAMA]);
        });
    }
    public static function findNim($nim): array
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($nim) {
            $table->selectWhere(["nim" => $nim], [self::ID, self::EMAIL, self::ID_USER, self::NIM, self::PRODI, self::NAMA, self::TOTAL_SKOR,self::FOTO]);
        });
    }

    public static function displayMahasiswa(): array
    {
        return Schema::selectFrom(self::TABLE, function (Blueprint $table) {
            $table->select();
        });
    }
    public static function deleteData($id): array
    {
        return Schema::query("DELETE FROM mahasiswa WHERE id ='$id' ;");
    }


    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }


    public static function getLeaderboard(): array
    {
        return Schema::selectFrom(self::VIEW, function (Blueprint $table) {
            $table->select();
        });
    }

    public static function getLeaderboardFilter($filter): array
    {
        return Schema::selectWhereFrom(self::VIEW, function (Blueprint $table) use ($filter){
            $table->selectWhere(
                ["prodi" => $filter], // Kondisi where
                [self::ID, self::NIM, self::PRODI, self::NAMA, self::TOTAL_SKOR] // Kolom yang akan diambil
            );
        });
    }




    public static function updateData($body): array
    {

        $id = $body['id'];
        $nama = $body["nama"];
        $nim = $body["nim"];
        $prodi = $body["prodi"];
        $jurusan  = $body["jurusan"];
        $tahun_masuk = $body["tahun_masuk"];
        $email = $body["email"];
        $foto = $body["foto"];
        return Schema::query(
            "UPDATE mahasiswa SET 
        nama = '$nama',
        nim = '$nim',
        prodi = '$prodi',
        jurusan = '$jurusan',
        tahun_masuk = '$tahun_masuk',
        foto = '$foto',
        email = '$email'
        WHERE id = '$id';
        "
        );
    }
}
