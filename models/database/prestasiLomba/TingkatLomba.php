<?php

namespace app\models\database\prestasiLomba;

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;

class TingkatLomba extends BaseModel
{
    public const TABLE = "tingkat_lomba";
    public const ID = "id";
    public const TINGKAT_LOMBA = "tingkat_lomba";
    public const SKOR = "skor";

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID,self::TINGKAT_LOMBA,self::SKOR], $data);
            
        });
    }
        public static function displayTingkatLomba():array
    {
        return Schema::selectFrom(self::TABLE, function (Blueprint $table) {
            $table->select();
        });
    }

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }
}

?>
