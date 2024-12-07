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
    

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID,self::ID_USER,self::NAMA,self::NIM,self:: PRODI,self::JURUSAN,
        self::TAHUN_MASUK,self::TOTAL_SKOR,self::FOTO,self::EMAIL], $data);
            
        });
    }
    public static function findEmail($email): array 
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($email) {
            $table->selectWhere(["email" => $email], [self::ID_USER,self::NAMA,self::EMAIL]);
        });   
    }
    public static function findNim($nim): array 
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($nim) {
            $table->selectWhere(["nim" => $nim], [self::ID,self::ID_USER,self::NIM,self:: PRODI,self::ID_USER]);
        });   
    }


    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }

}