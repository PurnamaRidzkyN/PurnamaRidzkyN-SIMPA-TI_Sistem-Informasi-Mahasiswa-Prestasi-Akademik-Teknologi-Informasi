<?php

namespace app\models\database\notifikasi;

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;

class Notifikasi extends BaseModel
{
    public const TABLE = "notifikasi";
    public const ID = "id";
    public const ID_USER = "id_user";
    public const ROLE = "role";
    public const PESAN = "pesan";
    public const TIPE = "tipe";
    public const  STATUS = "status";
    public const DIBUAT = "dibuat";

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID, self::ID_USER,self::ROLE, self::PESAN, self::TIPE, self::STATUS, self::DIBUAT], $data);
        });
    }
    public static function displayNotif(): array
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) {
            $table->select();
        });
    }
    public static function updateNotif(  string $where): array
    {
        return Schema::update(self::TABLE, function (Blueprint $table) use ( $where) {
            $table->update(self::STATUS, "dilihat", "id", $where);
        });
    }


    public static function deleteNotifikasi($id):array{
        return Schema::query("
        DELETE FROM notifikasi
        WHERE id = '$id' ;");
    }

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }
}
