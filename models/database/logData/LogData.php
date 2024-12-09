<?php

namespace app\models\database\logData;


use app\cores\Schema;
use app\cores\Blueprint;

class LogData
{
    public const TABLE = "log_data";
    public const ID = "id";
    public const ID_USER = "id_user";
    public const ID_PERUBAHAN = "id_perubahan";
    public const TABEL_PERUBAHAN = "tabel_perubahan";
    public const KETERANGAN_KEGIATAN = "keterangan_kegiatan";
    public const TANGGAL = "tanggal";
    public const VIEW_TABLE = "view_log_data";

    public static function insert(string $id, string $id_user, string $id_perubahan, string $tabel_perubahan, string $jenis_operasi, string $kolom_perubahan, string $data_lama, string $data_baru): array
    {
        
        return Schema::query("
        EXEC sp_LogData 
        @id = '$id', 
        @id_user = '$id_user', 
        @id_perubahan = '$id_perubahan', 
        @tabel_perubahan = '$tabel_perubahan', 
        @jenis_operasi = '$jenis_operasi', 
        @kolom_perubahan ='$kolom_perubahan', 
        @data_lama = '$data_lama', 
        @data_baru = '$data_baru';
    
  ");
    }

    public static function logDataDisplay(): array
    {
        return Schema::selectFrom(self::VIEW_TABLE, function (Blueprint $table) {
            $table->select();
        });
    }
    public static function getFilteredLogs($data): array
    {
        $data['CONVERT(DATE, tanggal)'] = $data['tanggal'];
        unset($data['tanggal']);
        $data = array_filter($data, function($value) {
            return $value !== "" && $value !== null;
        });     
        foreach ($data as $column => $value) {
            $conditions[] = "$column = '$value'";
        }
        
        $query = implode(" AND ", $conditions);
        return Schema::query("
        SELECT * FROM view_log_data WHERE ".$query);
        
    }
}
