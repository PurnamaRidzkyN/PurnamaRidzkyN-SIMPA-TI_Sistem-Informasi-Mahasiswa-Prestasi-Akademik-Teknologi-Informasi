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
            $max_size = 5 * 1024 * 1024; // Maksimal 5MB
            if ($file && isset($file["tmp_name"])) {
                $file_size = $file["size"];
                
                // Memeriksa ukuran file
                if ($file_size > $max_size) {
                    return "File terlalu besar. Maksimal ukuran file adalah 5MB.";
                }
    
                // Memeriksa tipe file menggunakan finfo_file()
                $finfo = finfo_open(FILEINFO_MIME_TYPE); // Mendapatkan tipe MIME file
                $file_info = finfo_file($finfo, $file["tmp_name"]);
                finfo_close($finfo); // Tutup resource finfo
    
                // Memeriksa apakah file adalah gambar
                if (strpos($file_info, "image") === 0) {
                    // Jika file adalah gambar, periksa jika formatnya valid (JPG, PNG, dll)
                    $image_info = getimagesize($file["tmp_name"]);
                    if ($image_info === false) {
                        return "File bukan gambar yang valid.";
                    }
                } 
                // Memeriksa jika file adalah dokumen
                elseif (strpos($file_info, "application/pdf") === 0 || strpos($file_info, "application/msword") === 0 || strpos($file_info, "application/vnd.openxmlformats-officedocument.wordprocessingml.document") === 0) {
                    // Jika file adalah PDF atau DOC/DOCX
                    // Tidak perlu cek khusus untuk format file seperti gambar
                } else {
                    return "001";
                }
        
                // Tentukan path tujuan
                $target_file = $target_dir . basename($file["name"]);
        
                // Pindahkan file yang diunggah ke direktori tujuan
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return $target_file;
                } else {
                    return "Terjadi kesalahan saat mengunggah file.";
                }
            } else {
                return "Tidak ada file yang diunggah.";
            }
        } catch (\PDOException $e) {
            return "Terjadi kesalahan: " . $e->getMessage();
        }
    }
    
}    
