<?php

namespace app\models\database\prestasiLomba;

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;

class Prestasi extends BaseModel
{
    public const TABLE = "prestasi";public const ID = "id";
    public const ID_JENIS_KOMPETISI = "id_jenis_kompetisi";
    public const ID_TINGKAT_KOMPETISI = "id_tingkat_kompetisi";
    public const ID_MAHASISWA = "id_mahasiswa";
    public const ID_PERINGKAT = "id_peringkat";
    public const ID_ADMIN = "id_admin";
    public const TIM = "tim";
    public const JUDUL_KOMPETISI = "judul_kompetisi";
    public const JUDUL_KOMPETISI_EN = "judul_kompetisi_en";
    public const TEMPAT_KOMPETISI = "tempat_kompetisi";
    public const TEMPAT_KOMPETISI_EN = "tempat_kompetisi_en";
    public const URL_KOMPETISI = "url_kompetisi";
    public const TANGGAL_MULAI = "tanggal_mulai";
    public const TANGGAL_AKHIR = "tanggal_akhir";
    public const JUMLAH_PT = "jumlah_pt";
    public const JUMLAH_PESERTA = "jumlah_peserta";
    public const NO_SURAT_TUGAS = "no_surat_tugas";
    public const TANGGAL_SURAT_TUGAS = "tanggal_surat_tugas";
    public const FILE_SURAT_TUGAS = "file_surat_tugas";
    public const FILE_SERTIFIKAT = "file_sertifikat";
    public const FOTO_KEGIATAN = "foto_kegiatan";
    public const FILE_POSTER = "file_poster";
    public const VALIDASI = "validasi";
    public const VIEW_TABLE = "view_prestasi";
    
    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([
                self::ID,
                self::ID_JENIS_KOMPETISI,
                self::ID_TINGKAT_KOMPETISI,
                self::ID_MAHASISWA,
                self::ID_PERINGKAT,
                self::ID_ADMIN,
                self::TIM,
                self::JUDUL_KOMPETISI,
                self::JUDUL_KOMPETISI_EN,
                self::TEMPAT_KOMPETISI,
                self::TEMPAT_KOMPETISI_EN,
                self::URL_KOMPETISI,
                self::TANGGAL_MULAI,
                self::TANGGAL_AKHIR,
                self::JUMLAH_PT,
                self::JUMLAH_PESERTA,
                self::NO_SURAT_TUGAS,
                self::TANGGAL_SURAT_TUGAS,
                self::FILE_SURAT_TUGAS,
                self::FILE_SERTIFIKAT,
                self::FOTO_KEGIATAN,
                self::FILE_POSTER,
                self::VALIDASI,
                
            ], $data);
        });
    }
    public static function listPrestasiDisplay():array
    {
        return Schema::selectFrom(self::VIEW_TABLE, function (Blueprint $table) {
            $table->select();
        });
    }
    public static function findId($id): array 
    {
        return Schema::selectWhereFrom(self::VIEW_TABLE, function (Blueprint $table) use ($id) {
            $table->selectWhere(["id" => $id] );
        });   
    }

    public static function updatePrestasi($value, string $columnWhere, string $where): array
    {
        return Schema::update(self::TABLE, function (Blueprint $table) use ($value, $columnWhere, $where) {
            $table->update(self::VALIDASI, $value, $columnWhere, $where);
        });
    }

    public static function updateIdAdmin($value, string $columnWhere, string $where): array
    {
        return Schema::update(self::TABLE, function (Blueprint $table) use ($value, $columnWhere, $where) {
            $table->update(self::ID_ADMIN, $value, $columnWhere, $where);
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

?>
