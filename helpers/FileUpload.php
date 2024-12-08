<?php

namespace Helpers;

class FileUpload
{
    private const TARGET_DIR = "public/uploads/";
    const TARGET_DIR_SURAT_TUGAS = self::TARGET_DIR . "suratTugas/";
    const TARGET_DIR_SERTIFIKAT = self::TARGET_DIR . "sertifikat/";
    const TARGET_DIR_FOTO = self::TARGET_DIR . "fotokegiatan/";
    const TARGET_DIR_POSTER = self::TARGET_DIR . "poster/";
    const TARGET_DIR_FOTO_PROFILE = self::TARGET_DIR . "fotoProfiles/";
    const TARGET_DIR_LOMBA = self::TARGET_DIR . "lomba/";
    
    public static function uploadFile($file, $target_dir)
    {
        $max_size = 5 * 1024 * 1024;
        if ($file && isset($file["tmp_name"]) && $file["error"] == 0) {
            $file_size = $file["size"];
            if ($file_size > $max_size) {
                // Handle the case where the file size exceeds the limit
            } else {
                $target_file = $target_dir . basename($file["name"]);
                move_uploaded_file($file["tmp_name"], $target_file);
            }
        } else {
            echo "File tidak diunggah atau terjadi kesalahan.<br>";
        }

        return $target_file;
    }
}
