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
    public const TAHUN_MASUK = "tahun_masuk";
    public const TOTAL_SKOR = "total_skor";
    public const FOTO = "foto";
    

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID,self::ID_USER,self::NAMA,self::NIM,self:: PRODI,
        self::TAHUN_MASUK,self::TOTAL_SKOR,self::FOTO], $data);
            
        });
    }

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }

}