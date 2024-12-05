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

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }
}

?>
