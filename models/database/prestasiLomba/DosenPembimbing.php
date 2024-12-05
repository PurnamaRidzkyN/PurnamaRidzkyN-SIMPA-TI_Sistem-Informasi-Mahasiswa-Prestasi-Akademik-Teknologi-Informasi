<?php

namespace app\models\database\prestasiLomba;

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;

class DosenPembimbing extends BaseModel
{
    public const TABLE = "dosen_Pembimbing";
    public const ID = "id";
    public const ID_Dosen = "id_dosen";
    public const ID_PRESTASI = "id_prestasi";

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID,self::ID_Dosen,self::ID_PRESTASI], $data);
            
        });
    }

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }
}

?>
