<?php

namespace app\helpers;

class FileUpload
{
    private const TARGET_DIR = "public/uploads/";
    public const TARGET_DIR_SURAT_TUGAS = self::TARGET_DIR . "suratTugas/";
    public const TARGET_DIR_SERTIFIKAT = self::TARGET_DIR . "sertifikat/";
    public const TARGET_DIR_FOTO = self::TARGET_DIR . "fotokegiatan/";
    public const TARGET_DIR_POSTER = self::TARGET_DIR . "poster/";
    public const TARGET_DIR_FOTO_PROFILE = self::TARGET_DIR . "fotoProfiles/";
    public const TARGET_DIR_LOMBA = self::TARGET_DIR . "lomba/";

    public static function uploadFile($file, $target_dir)
    {
        try {
            $max_size = 5 * 1024 * 1024;
            if ($file && isset($file["tmp_name"]) ) {
                $file_size = $file["size"];
                if ($file_size > $max_size) {
                   return "0";
                } else {
                    $target_file = $target_dir . basename($file["name"]);
                    move_uploaded_file($file["tmp_name"], $target_file);
                }
            } else {
                return "0";
            }

            return $target_file;
        } catch (\PDOException $e) {
            return($e->getMessage());
        }
    }
}
