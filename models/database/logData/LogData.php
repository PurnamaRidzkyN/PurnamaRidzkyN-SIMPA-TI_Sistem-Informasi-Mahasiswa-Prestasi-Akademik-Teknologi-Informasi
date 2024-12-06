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

    public static function insert(string $id,string $id_user ,string $id_perubahan,string $tabel_perubahan,string $jenis_operasi,string $kolom_perubahan,string $data_lama,string $data_baru): array
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
    
  ");}

  public static function displayLogData():array
  {
    return Schema::selectFrom(self::TABLE,function (Blueprint $table) {
        $table->select([self::ID,self::ID_USER,self::ID_PERUBAHAN, self::TABEL_PERUBAHAN, self::KETERANGAN_KEGIATAN, self::TANGGAL]);
    });
  }
  
}
