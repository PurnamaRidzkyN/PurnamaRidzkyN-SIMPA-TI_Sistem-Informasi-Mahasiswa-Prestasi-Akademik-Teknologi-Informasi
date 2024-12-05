<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;

class Admin extends BaseModel
{
    public const TABLE = "admin";
    public const ID = "id";
    public const ID_USER = "id_user";
    public const NIP = "nip";
    public const NAMA = "nama";
    public const FOTO = "foto";
    public const EMAIL = "email";


    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID, self::ID_USER, self::NIP, self::NAMA, self::FOTO, self::EMAIL], $data);
        });
    }

    public static function findEmail($email): array 
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($email) {
            $table->selectWhere(["email" => $email], [self::ID, self::ID_USER, self::NIP, self::EMAIL]);
        });   
    }


    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }
}
