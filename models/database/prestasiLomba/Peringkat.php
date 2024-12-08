<?php

namespace app\models\database\prestasiLomba;

use app\cores\Blueprint;
use app\cores\Schema;
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
            $table->insert([self::ID,self::PERINGKAT,self::SKOR], $data);
            
        });
    }

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }

}

?>
