<?php

namespace app\models\database\prestasiLomba;

use app\cores\Blueprint;
use app\cores\Schema;
use app\helpers\Dump;
use app\models\BaseModel;

class Peringkat extends BaseModel
{
    public const TABLE = "peringkat";
    public const ID = "id";
    public const PERINGKAT = "peringkat";
    public const SKOR = "skor";

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID, self::PERINGKAT, self::SKOR], $data);
        });
    }
    public static function displayPeringkat(): array
    {
        return Schema::selectFrom(self::TABLE, function (Blueprint $table) {
            $table->select();
        });
    }

    public static function updateData($body): array
    {

        $id = $body['id'];
        $peringkat = $body["peringkat"];
        $skor = $body["skor"];
        return Schema::query(
            "UPDATE peringkat SET 
        peringkat = '$peringkat',
        skor = '$skor'
        WHERE id = '$id';
        "
        );
    }


    public static function findPeringkat(string $column, $value): array
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($column, $value) {
            $table->selectWhere([$column => $value], [self::ID, self::PERINGKAT, self::SKOR]);
        });
    }

    public static function deleteData($id): array
    {
        return Schema::query("DELETE FROM " . self::TABLE . " WHERE " . self::ID . " = '$id';");
    }

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }
}
