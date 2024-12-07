<?php

namespace app\models\database\prestasiLomba;

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;

class InfoLomba extends BaseModel
{
    public const TABLE = "info_lomba";
    public const ID = "id";
    public const JUDUL = "judul";
    public const DESKRIPSI_LOMBA = "deskripsi_lomba";
    public const TANGGAL_AKHIR_PENDAFTARAN = "tanggal_akhir_pendaftaran";
    public const LINK_PERLOMBAAN = "link_perlombaan";
    public const FILE_POSTER = "file_poster";

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([
                self::ID,
                self::JUDUL,
                self::DESKRIPSI_LOMBA,
                self::TANGGAL_AKHIR_PENDAFTARAN,
                self::LINK_PERLOMBAAN,
                self::FILE_POSTER
            ], $data);
            
        });
    }

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }

    public static function getAll(): array
{
    return Schema::selectFrom(self::TABLE, function (Blueprint $table) {
        $table->select();
    });
}

}

?>
