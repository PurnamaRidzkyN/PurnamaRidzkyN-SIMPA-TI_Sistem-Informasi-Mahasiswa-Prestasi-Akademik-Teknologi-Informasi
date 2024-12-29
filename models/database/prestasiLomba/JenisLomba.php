<?php

namespace app\models\database\prestasiLomba;

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;

class JenisLomba extends BaseModel
{
    public const TABLE = "jenis_lomba";
    public const ID = "id";
    public const JENIS_LOMBA = "jenis_lomba";

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID,self::JENIS_LOMBA], $data);
            
        });
    }
    public static function displayJenisLomba():array
    {
        return Schema::selectFrom(self::TABLE, function (Blueprint $table) {
            $table->select();
        });
    }

    public static function updateJenisLomba(string $column, $value, string $columnWhere, string $where): array
    {
        return Schema::update(self::TABLE, function (Blueprint $table) use ($column, $value, $columnWhere, $where) {
            $table->update($column, $value, $columnWhere, $where);
        });
    }
    

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }

    public static function find(string $column, $value): array
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($column, $value) {
            $table->selectWhere(["$column" => $value], [self::ID, self::JENIS_LOMBA]);
        });
    }

    // Fungsi deleteData untuk menghapus data berdasarkan ID
    public static function deleteData($id): array
    {
        return Schema::query("DELETE FROM " . self::TABLE . " WHERE " . self::ID . " = '$id';");
    }
}

?>
