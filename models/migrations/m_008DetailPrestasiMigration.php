<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_008DetailPrestasiMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("detail_prestasi", function (Blueprint $table) {
            $table->int("id");
            $table->int("id_jenis_kompetisi");
            $table->int("id_tingkat_kompetisi");
            $table->int("id_mahasiswa");
            $table->int("id_dosen");
            $table->int("id_peringkat");
            $table->tinyInt("tim");
            $table->string("judul_kompetisi");
            $table->string("judul_kompetisi_en");
            $table->string("tempat_kompetisi");
            $table->string("tempat_kompetisi_en");
            $table->string("url_kompetisi");
            $table->date("tanggal_mulai");
            $table->date("tanggal_akhir");
            $table->int("jumlah_pt");
            $table->int("jumlah_peserta");
            $table->string("no_surat_tugas");
            $table->date("tanggal_surat_tugas");
            $table->string("file_surat_tugas");
            $table->string("file_sertifikat");
            $table->string("foto_kegiatan");
            $table->string("file_poster");
            $table->tinyInt("validasi");

            $table->primary("id");
            $table->unique("id_jenis_kompetisi");
            $table->unique("id_tingkat_kompetisi");
            $table->unique("id_mahasiswa");
            $table->unique("id_dosen");
            $table->unique("id_peringkat");
            
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("detail_prestasi");
    }
}
